<?php

namespace App;


use General;
use Hash;
use URL;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable as Notify;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notify;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'players';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user', 'Email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['pass'];
	
	public $timestamps = false;
	
	// protected $dates = ['playerLastSeen'];

	public function getAuthIdentifier() { return $this->ID; }
	public function getAuthPassword() { return Hash::make($this->pass); }
	public function getRememberToken() { return null; }
	public function setRememberToken($value) 
	{
		
	}
	public function getRememberTokenName() { return null; }
	public function getEmailForPasswordReset() { return $this->Email; }

	/**
	* Overrides the method to ignore the remember token.
	*/
	public function setAttribute($key, $value)
	{
		$isRememberTokenAttribute = $key == $this->getRememberTokenName();
		if(!$isRememberTokenAttribute) { parent::setAttribute($key, $value); }
	}
	public function scopeGroup($query, $group) { return $query->where('Member', $group); }
	public function getUrlAttribute() { return urldecode('<a id="'.$this->ID.'" href="'.URL::to('user/profile',[$this->user]).'">'.$this->user.'</a>'); }
	public function getStatusTextAttribute()
    {
        switch($this->Status) {
			case 0: { return '<span class="label label-danger">Offline</span>'; break; }
			case 1: { return '<span class="label label-success">Online</span>'; break; }
			default: { return '<span class="label label-danger">Sleep</span>'; break; }
		}
    }
    public function getStatusBubbleAttribute()
    {
        switch($this->Status) {
			case 0: { return '<i class="fa fa-frown-o fa-fw" style="color:red;"></i>'; break; }
			case 1: { return '<i class="fa fa- fa-fw" style="color:green;"></i>'; break; }
			default: { return '<i class="fa fa-bolt fa-fw" style="color:orange;"></i>'; break; }
		}
    }
	public function getRolesAttribute() 
	{
		$_roles = '';
		($this->VIP != 0) ? $_roles .= ' <span class="label label-danger"><i class="fa fa-dollar"></i> V.I.P</span> ' : false;  
		($this->Premium != 0) ? $_roles .= ' <span class="label label-warning"><i class="fa fa-star"></i> Premium</span> ' : false;  
		($this->Admin != 0) ? $_roles .= ' <span class="label label-primary"><i class="fa fa-legal"></i> Admin</span> ' : false;  
		($this->Helper != 0) ? $_roles .= ' <span class="label label-info"><i class="fa fa-child"></i> Helper</span> ' : false;  
		($this->Rank == 10) ? $_roles .= ' <span class="label label-success"><i class="fa fa-asterisk"></i> Leader</span> ' : false;   
		($this->pTester == 1) ? $_roles .= ' <span class="label label-inverse"><i class="fa fa-check-circle"></i> Tester</span> ' : false;   
		return $_roles;
	}
	public function cars() { return $this->hasMany('App\Car','Owner','ID'); }
	public function house() { return $this->hasOne('App\House','Owner','name'); }
	public function business() { return $this->hasOne('App\Business','Owner','name'); }
	public function carss() { return $this->hasOne('App\Clan','ID',$this->Clan); }
    public function getFactionIdAttribute() { return $this->Member; }
	public function getNameAttribute() { return $this->user; }	
	public function getAdminLevelAttribute() { return $this->Admin; }	
	public function getClanIdAttribute() { return $this->Clan+1; }	
	public function getSkinAttribute() { return $this->SkinID; }
	public function getLevelAttribute() { return $this->Score; }	
    public function getFactionAttribute() { return General::faction($this->faction_id,'name'); }
    public function getFactionShortAttribute() { return General::faction($this->faction_id,'short'); }
	public function getFactionColorAttribute() { return General::faction($this->faction_id,'color'); }
}

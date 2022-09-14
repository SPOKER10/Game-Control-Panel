<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Complaint extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_complaints';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'complaint_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['complaint_userid', 'complaint_foruserid', 'complaint_code', 'complaint_type', 'complaint_reason', 'complaint_description', 'complaint_proof','complaint_comments', 'complaint_faction'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    private static $types = ['player' => 0,'leader' => 1,'helper' => 2,'admin' => 3,'faction' => 4,];
    private static $reasons = [
        //jucator
    	0 => ['Limbaj', 'Deathmatch', 'Hacking', 'Inselatorie', 'Altul',],
        //leader
        1 => ['Limbaj', 'Deathmatch', 'Hacking', 'Abuz', 'Inselatorie', 'Altul',],
        //helper
        2 => ['Limbaj', 'Deathmatch', 'Hacking', 'Abuz', 'Inselatorie', 'Altul',],
        //admin
        3 => ['Limbaj', 'Deathmatch', 'Hacking', 'Abuz', 'Inselatorie', 'Altul',],
        4 => ['Abuz', 'Inselatorie', 'Limbaj', 'Altul',]
    ];

    private static $statuses = [0 => '<span class="orange">Un-Answered</span>', 1 => '<span class="green">Answered</span>',];
	public static $actions = [
        'nothing' => 'Nothing', 'mute15' => 'Muted', 'jail' => 'AJailed', 'warn' => 'Warn', 'ban1' => 'Banned temporary', 'ban3' => 'Banned permanent',
		
		'fpunish' => 'Faction punish', 'fwarn' => 'Faction warn', 'uninvite' => 'Uninvite',
	];
	
    public function user() { return $this->belongsTo('App\User','complaint_userid','ID'); }
    public function against() { return $this->hasOne('App\User','ID','complaint_foruserid'); }
    public function getAgainstIdAttribute() { return $this->complaint_foruserid; }
    public function getUserIdAttribute() { return $this->complaint_userid; }
    public function scopeType($query, $type, $faction = null)
    {
        if(!$faction) return $query->where('complaint_type', self::$types[$type]);
        else return $query->where('complaint_type', self::$types[$type])->where('complaint_faction',$faction);
    }
    public function scopeCode($query, $code) { return $query->where('complaint_code', $code); }
    public function getIdAttribute() { return $this->complaint_id; }
    public function getDescriptionAttribute() { return $this->complaint_description; }
    public function getCommentsAttribute() { return $this->complaint_comments; }
    public function getProofAttribute() { return $this->complaint_proof; }	
	public function getActionAttribute() { return $this->complaint_action; }
    public function getStatusAttribute() { return ucfirst(self::$statuses[$this->complaint_status]); }
    public function getGetTypeAttribute() { return ucfirst(array_search($this->complaint_type,self::$types)); }
    public function getReasonAttribute() { return self::$reasons[$this->complaint_type][$this->complaint_reason]; }
	public function getActionTextAttribute() { return self::$actions[$this->complaint_action]; }
    public static function getTypes($user)
    {
        $html = '<option value="-1">Niciunul</option>';
        if(isset($user)) {
            $html .= '<option value="0" style="color:green;">Jucator</option>';
            if($user->Rank == 10) $html .= '<option value="1" style="color:green;">Leader (' . \General::faction($user->faction_id,'name') . ')</option>';
				else $html .= '<option disabled style="color:red;">Leader</option>';
            if($user->HelperLevel) $html .= '<option value="2" style="color:green;">Helper</option>';
				else $html .= '<option disabled style="color:red;">Helper</option>';
            if($user->AdminLevel) $html .= '<option value="3" style="color:green;">Admin</option>';
				else $html .= '<option disabled style="color:red;">Admin</option>';
            if($user->Member && $user->Rank < 10) $html .= '<option value="4" style="color:green;">Factiune (' . \General::faction($user->faction_id,'name') . ')</option>';
				else $html .= '<option disabled style="color:red;">Factiune</option>';
        }
        return $html;
    }
    public static function getReasons($type)
    {
        $html = '<option value="-1">Niciunul</option>';
        if($type != -1)
            foreach (self::$reasons[$type] as $k=>$r) { $html .= '<option value="'.$k.'">'.$r.'</option>'; }
        return $html;
    }
    public function getUrlAttribute($type) { return urldecode(URL::to('complaints/view',[$this->complaint_code])); }
}

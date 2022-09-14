<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Application extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_applications';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'application_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['application_userid','application_type','application_faction','application_status','application_questions','application_code','OPrec'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    private static $types = ['faction' => 0, 'leader' => 1, 'helper' => 2,];
    private static $statuses = [0 => '<span class="orange">Un-answered</span>', 1 => '<span class="yellow">Accepted tests</span>', 2 => '<span class="green">Accepted <i style="color:green" class="fa fa-smile-o"></i></span>', 3 => '<span class="red">Rejected <i style="color:red" class="fa fa-frown-o"></i></span>', 4 => '<span class="red">Cancelled <i style="color:red" class="fa fa-lock"></i></span>',];	
    public function user() { return $this->belongsTo('App\User','application_userid','ID'); }
	public function acby() { return $this->belongsTo('App\User','Accby','ID'); }
    public function scopeType($query, $type, $faction = null)
    {
        if(!$faction) return $query->where('application_type', self::$types[$type]);
        else return $query->where('application_type', self::$types[$type])->where('application_faction',$faction);
    }
    public function getIdAttribute() { return $this->application_id; }
    public function getFactionAttribute() { return $this->application_faction; }
    public function getQuestionsAttribute() { return $this->application_questions; }
    public function getStatusAttribute() { return self::$statuses[$this->application_status]; }
	public function getGetTypeAttribute() { return ucfirst(array_search($this->application_type,self::$types)); }
    public function getUrlAttribute($type) { return urldecode(URL::to('applications/view',[$this->application_code])); }
}

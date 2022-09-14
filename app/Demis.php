<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Demis extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_demis';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'demis_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['demis_userid','demis_type','demis_faction','demis_status','demis_code','Motiv','Prec','OPrec'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    private static $types = ['faction' => 0, 'leader' => 1, 'helper' => 2,];
    private static $statuses = [0 => '<span class="orange">Un-answered</span>', 1 => '<span class="green">Accepted <i style="color:green" class="fa fa-smile-o"></i></span>', 2 => '<span class="red">Rejected <i style="color:red" class="fa fa-frown-o"></i></span>',];	
    public function user() { return $this->belongsTo('App\User','demis_userid','ID'); }
	public function acby() { return $this->belongsTo('App\User','Accby','ID'); }
    public function scopeType($query, $type, $faction = null) { return $query->where('demis_type', self::$types[$type])->where('demis_faction',$faction); }
    public function getIdAttribute() { return $this->demis_id; }
    public function getFactionAttribute() { return $this->demis_faction; }
    public function getQuestionsAttribute() { return $this->demis_questions; }
    public function getStatusAttribute() { return self::$statuses[$this->demis_status]; }
    public function getUrlAttribute($type) { return urldecode(URL::to('demis/view',[$this->demis_code])); }
}

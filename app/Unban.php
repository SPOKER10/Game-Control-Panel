<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Unban extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_unban';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'unban_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['unban_userid', 'unban_code', 'unban_status', 'unban_img', 'unban_reason','unban_description', 'unban_comments', 'IP'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
	
    protected $dates = ['created_at'];

    public static $statuses = [0 => '<span class="orange">Un-Answered</span>', 1 => '<span class="red">Ban remains <i class="fa fa-frown-o"></i></span>', 2 => '<span class="green">Unbanned <i class="fa fa-smile-o"></i></span>',];
	public function user() { return $this->belongsTo('App\User','unban_userid','ID'); }
    public function getUserIdAttribute() { return $this->unban_userid; }
    public function getIdAttribute() { return $this->unban_id; }	
	public function getImgAttribute() { return $this->unban_img; }
    public function getCommentsAttribute() { return $this->unban_comments; }
	public function getReasonAttribute() { return $this->unban_reason; }
    public function getDescriptionAttribute() { return $this->unban_description; }
    public function getStatusAttribute() { return ucfirst(self::$statuses[$this->unban_status]); }
    public function getUrlAttribute($type) { return urldecode(URL::to('unban/view',[$this->unban_code])); }
}

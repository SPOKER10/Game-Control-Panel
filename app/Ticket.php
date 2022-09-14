<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Ticket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_tickets';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'ticket_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ticket_userid', 'ticket_code', 'ticket_type', 'ticket_description', 'ticket_comments', 'IP'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
	
    protected $dates = ['created_at'];

    public static $types = [0 => 'General', 1 => 'Cont', 2 => 'YouTube', 3 => 'Altul',];
    public static $statuses = [0 => '<i class="fa fa-unlock" style="color:green"></i> Open', 1 => '<i class="fa fa-lock" style="color:red"></i> Closed',];
	public function user() { return $this->belongsTo('App\User','ticket_userid','ID'); }
    public function getUserIdAttribute() { return $this->ticket_userid; }
    public function getIdAttribute() { return $this->ticket_id; }
    public function getDescriptionAttribute() { return $this->ticket_description; }
    public function getCommentsAttribute() { return $this->ticket_comments; }
    public function getStatusAttribute() { return ucfirst(self::$statuses[$this->ticket_status]); }	
	public function getGetTypeAttribute() { return ucfirst(self::$types[$this->ticket_type]); }
    public function getUrlAttribute($type) { return urldecode(URL::to('tickets/view',[$this->ticket_code])); }
}

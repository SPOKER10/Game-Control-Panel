<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class Donation extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'donations';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'donateID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['donateName','donateSUM','donateTime'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
	
    protected $dates = ['created_at'];

	public $timestamps = false;
    public function user() { return $this->belongsTo('App\User','donateName','ID'); }
    public function getUrlAttribute($type) { return urldecode(URL::to('donation/view',[$this->donateID])); }
}

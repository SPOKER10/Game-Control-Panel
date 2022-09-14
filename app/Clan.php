<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clan extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clans';
	
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
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

	public function members() { return $this->hasMany('App\User','Clan','ID'); }
    public function user() { return $this->belongsTo('App\User','Owner','ID'); }
}

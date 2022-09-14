<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bll extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'billboards';
	
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

    public function user() { return $this->belongsTo('App\User','OwnID','ID'); }
}

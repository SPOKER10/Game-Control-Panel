<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cnn extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cnn';
	
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

    public function user() { return $this->belongsTo('App\User','AnID','ID'); }
}

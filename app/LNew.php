<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LNew extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logfactionsnew';
	
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
	
}

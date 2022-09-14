<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inf_options';
	
	/**
     * The database table id used by the model.
     *
     * @var string
     */
    protected $primaryKey = 'option_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['option_name','option_value'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
	

}

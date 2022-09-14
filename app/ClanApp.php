<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use URL;

class ClanApp extends Model
{
    protected $table = 'inf_clanapps';
	
    protected $primaryKey = 'id';

    protected $fillable = ['userid','type','clan','questions','code'];

    protected $hidden = [];

    private static $types = [
        'applications' => 0,
        'resignations' => 1,
    ];

    private static $statuses = [
        0 => '<span class="orange">Un-answered</span>',
        1 => '<span class="yellow">Accepted tests</span>',
        2 => '<span class="green">Accepted <i style="color:green" class="fa fa-smile-o"></i></span>',
        3 => '<span class="red">Rejected <i style="color:red" class="fa fa-frown-o"></i></span>',
        4 => '<span class="red">Cancelled <i style="color:red" class="fa fa-lock"></i></span>',
    ];	

    public function user() { 
        return $this->belongsTo('App\User','userid','ID');
    }

    public function ans() { 
        return $this->hasOne('App\User','ID','answerer');
    }

    public function clan() {
        return $this->hasOne('App\Clan', 'ID', 'clan'); 
    }

    public function getStatusTextAttribute() { 
        return self::$statuses[$this->status];
    }

    public function getTypeTextAttribute() { 
        return substr(ucfirst(array_search($this->type, self::$types)), 0, -1);
    }

    public function getUrlAttribute($type) { 
        return urldecode(route('clanViewApp',[$this->clan, array_search($this->type, self::$types), $this->code]));
    }
}

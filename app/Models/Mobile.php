<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mobile extends Model
{
    protected $table = "mobile";
    protected $fillable = ['code','phone','user_id'];
    protected $hidden = ['user_id'];
    public $timestamps = false;

    ######### Begin Relations #########
    public function phone(){
        return $this -> belongsTo('App\User','id');
    }
    ######### End Relations ##########
}

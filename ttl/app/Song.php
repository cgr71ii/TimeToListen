<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{

    public function user_uploaded(){
        return $this->belongsTo('App\User');
    }

    public function status(){
        return $this->hasMany('App\User');
    }

    public function genres(){
        return $this->belongsToMany('App\Genre')->withTimestamps();
    }
}
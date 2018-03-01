<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user_send(){
        return $this->belongsTo('App\User');
    }

    public function user_receive(){
        return $this->belongsToMany('App\User');
    }
}

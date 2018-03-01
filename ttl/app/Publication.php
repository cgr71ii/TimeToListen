<?php

namespace App;

use Illuminate\Databse\Eloquent\Model;

class Publication extends Model{
    public function user_publish(){
        return $this->belongsTo('App\User');
    }
}
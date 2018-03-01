<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function user_publish(){

        return $this->belongsTo('App\User');

    }
}

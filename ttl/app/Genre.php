<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    public function genre_song()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

}

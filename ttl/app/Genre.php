<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{

    protected $fillable = ['id', 'name', 'created_at', 'updated_at'];

    public function songs()
    {
        return $this->belongsToMany('App\Song')->withTimestamps();
    }

}

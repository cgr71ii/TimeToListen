<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = ['name','creator_id'];

    public function publications()
    {
        return $this->hasMany('App\Publication');
    } 

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function creator()
    {
        return $this -> belongsTo('App\User');
    }
}

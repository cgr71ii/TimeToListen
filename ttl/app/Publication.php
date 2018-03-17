<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    public function user(){

        /*
         * Si se quiere que la funcion se llame diferente a la convencion utilizada por Laravel:
         * 
         * public function user_publish(){
         *      return $this->belongsTo('App\User', 'user_id');
         * }
         */

        return $this->belongsTo('App\User');

    }

    public function group()
    {
        return $this->belongsTo('App\Group');
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
    public function company(){
        $this->belongsTo('App\User');
    }
}

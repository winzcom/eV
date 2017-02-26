<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Vicinity extends Model
{
    //

    protected $table = 'vicinities';
    protected $fillable = [

    ];

    public function user(){
        return $this->hasMany('App\User');
    }
}

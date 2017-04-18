<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BaysianAverage extends Model
{
    //
    protected $table = 'bayesian_average';

    protected $fillable = ['bay_average,review_for'];

    public function user(){
        return $this->belongsTo('App\Entities\User');
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = "galleries";

    protected $fillable = ['user_id','image_name','caption'];

    protected $casts = ['publish'=>'boolean'];

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function getCaptionAttribute($value){

        echo html_entity_decode($value);
    }
}

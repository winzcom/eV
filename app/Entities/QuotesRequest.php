<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuotesRequest extends Model
{
    //

    protected $table = 'quotes_request';

    protected $fillable = [
        'category_id',
        'client_id',
        'state',
        'vicinity_id',
        'request'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->belongsTo('App\Entities\Category');
    }

    public function quote(){
        return $this->hasMany('App\Entities\Quote','rid');
    }
}
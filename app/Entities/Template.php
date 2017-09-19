<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //

    protected $table = 'templates';
    protected $guarded = [
        'id'
    ];

    public function user() {
        return $this->belongsTo('App\Entities\User','company_id');
    }
}

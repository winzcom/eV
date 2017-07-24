<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    public function companies(){
        return $this->belongsToMany('App\Entities\User','company_category','category_id','company_id');
    }

    public function requests() {
        return $this->hasMany('App\Entities\QuotesRequest');
    }
}

<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class DismissedRequest extends Model
{
    //
    protected $table = 'dismiss';

    protected $with = ['client','request'];

    public function client() {
        return $this->belongsTo('App\Entities\Customer','client_id');
    }

    public function request() {
        return $this->belongsTo('App\Entities\QuotesRequest','rid');
    }
}

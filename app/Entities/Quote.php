<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    //

    protected $table = 'quotes';
    protected $fillable = [
        'rid','uid','cost','message','contact','client_id'
    ];

    public function requests() {
        return $this->belongsTo('App\Entities\QuotesRequest','rid');
    }

    public function vendor() {
        return $this->belongsTo('App\Entities\User','uid');
    }
}

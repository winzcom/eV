<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = "reviews";

    protected $fillable = [
        'reviewers_name',
        'reviewers_email',
        'rating',
        'review',
        'review_for',
        'reply',
        'reviewers_id'
    ];

    public function user(){
        return $this->belongsTo('App\User','review_for');
    }
}

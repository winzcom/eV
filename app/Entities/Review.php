<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $table = "reviews";

    protected $appends = [
        'review_pictures'
    ];

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

    public function getReviewPicturesAttribute() {
        if( $this->hasReviewPictures() ) {
            $review_pictures = json_decode($this->review_image);
            return $review_pictures;
        }
        return null;
    }

    public function hasReviewPictures() {
        return ! is_null($this->review_image) && !empty($this->review_image) && count($this->review_image) > 0;
    }
}

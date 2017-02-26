<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon;

class OffDays extends Model
{
    //
     protected $table = 'offdays';
     protected $fillable = [
         'from_date',
         'to_date',
         'user_id'
     ];
     protected $dates = [
         'from_date',
         'to_date'
     ];

     public function user(){
        return $this->belongsTo('App\User');
    }
}

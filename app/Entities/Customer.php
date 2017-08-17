<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Notifications\ClientResetPassword;


class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "users";
    protected $fillable = [
        'name','email','password','first_name','last_name','firebase_endpoint',
        'phone_no'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPassword($token));
    }

}

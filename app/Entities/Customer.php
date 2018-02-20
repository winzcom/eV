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

    protected $appends = ['full_name'];
    protected $casts = ['can_chat'=>'boolean'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ClientResetPassword($token));
    }

    public function getFullNameAttribute() {
        return $this->first_name.' '.$this->last_name;
    }

    public function canChat() {
        $this->update(['can_chat'=>1]);
    }

    public function self_vendor_chat_channel() {
        return $this->belongsToMany(User::class,'channel_urls','client_id','vendor_id')->withPivot(['channel_url']);
    }
}

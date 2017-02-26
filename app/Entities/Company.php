<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class Company extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "companies";
    protected $fillable = [
        'name','email','password','first_name','last_name',
        'category','state',
        'description',
        'phone_no','house_no','street_name','name_slug'
    ];

    /*protected static  $formInputs = [
        'name','email','password','password_confirm','first_name','last_name',
        'phone_no',
        'house_no',
        'street_name',
        'state',
        'category',
        'description'
    ];*/

    protected static $formInputs = [
        'Personal Details'=>[
            'first_name','last_name','email','password','password_confirm'
        ],
        'Company Details'=>[
            'name',
            'house_no',
            'street_name','state','category','description','phone_no'
        ]
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function rules()
    {
        $user = Auth::user();
        return [
            'name' => 'required|max:255',
            'email' => ['required',Rule::unique('companies')->ignore($user->id)],
            'password' => 'required|min:6|confirmed',
            'phone_no'=>'required',
            'house_no'=>'required',
            'street_name'=>'required',
            'state'=>'required',
            'category'=>'required',
            'description'=>'required',
            'first_name'=>'required',
            'last_name'=>'required'
        ];
    }

    public static function getFormInputs(){
        return self::$formInputs;
    }

    public function categories(){
       return $this->belongsToMany('App\Category','company_category','company_id','category_id');
    }

    public function addresses(){
        $this->hasMany('App\Address');
    }

    public function galleries(){

        return $this->hasMany('App\Gallery');
    }

    public function reviews(){
        return $this->hasMany('App\Review','review_for');
    }

    public function getRouteKeyName(){
        return 'name_slug';
    }

    public function hasGalleries(){
        return false;
    }

    public function scopeState($query,$state = null){

        return $state !== 'all' ? $query->where('state',$state) : $query;
    }
}

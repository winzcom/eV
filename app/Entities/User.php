<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class User extends Authenticatable
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
        'vicinity_id',
        'description',
        'summary',
        'phone_no','house_no','street_name','name_slug',
        'company_image'
    ];

    protected static $formInputs = [
        'Personal Details'=>[
            'first_name','last_name','email','password','password_confirm'
        ],
        'Company Details'=>[
            'name',
            'house_no',
            'street_name',
            'state',
            'vicinity_id',
            'category',
            'summary',
            'description',
            'phone_no',
            'company_image'
        ]
    ];

    public static $registerInputs = [
        'Personal Details'=>[
            'first_name','last_name','email','password','password_confirm','phone_no'
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


    /*public static function rules()
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
            'vicinity_id'=>'required',
            'description'=>'required',
            'summary'=>'required',
            'first_name'=>'required',
            'last_name'=>'required'
        ];
    }*/

    public static function getFormInputs(){
        return self::$formInputs;
    }

    public static function getRegisterInputs(){
        return self::$registerInputs;
    }

    public function categories(){
       return $this->belongsToMany('App\Entities\Category','company_category','company_id','category_id');
    }

    public function categoriesCount() {
         return $this->categories()->count();
    }

    public function addresses(){
        $this->hasMany('App\Entities\Address');
    }

    public function galleries(){

        return $this->hasMany('App\Entities\Gallery');
    }

    public function getDescriptionAttribute($value){

        return  html_entity_decode($value);
    }

    public function reviews(){
        return $this->hasMany('App\Entities\Review','review_for');
    }

    public function vicinity(){
        return $this->belongsTo('App\Entities\Vicinity','vicinity_id');
    }

    public function offdays(){
        return $this->hasMany('App\Entities\OffDays','user_id');
    }

    public function getRouteKeyName(){
        return 'name_slug';
    }

    public function hasGalleries(){
        return $this->galleries()->count() > 0;
    }

    public function scopeStateVicinity($query,$state = null,$vicinity = null){

        /*return $state !== 'all' && $vicinity !== 'all' ? $query->where(['state'=>$state,
            'vicinity'=>$vicinity
        ]) : $query;*/

        if($state !== 'all'){
            if(($vicinity !== null) && ($vicinity !== 'all') && ($vicinity != 0))
                    return $query->where(['state'=>$state,'vicinity_id'=>$vicinity]);
             else return $query->where('state',$state);
        }
        else return $query;
    }

    public function bay_average(){
        return $this->hasOne('App\Entities\BaysianAverage','review_for');
    }
}

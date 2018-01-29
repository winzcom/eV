<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Entities\QuotesRequest;
use App\Entities\DismissedRequest;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = "companies";

    protected $withs = ['offday'];

    protected $casts = ['available'=>'boolean'];

    protected $date = ['created_at','updated_at','availability_set_date'];

    protected $appends = ['company_image_path_is_s3'];

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

    public function dismissedRequestsId() {
        return DismissedRequest::where('uid',$this->id)->get();
    }

    private function manyThrough($related,$through,$foreign_key_in_related,$foreign_key_in_through,$withs = []) {
        $requests = new $related; $through = new $through;
        $pivot_table = $through->getTable(); $table = $requests->getTable();

        if(count($withs) > 0 ) {
            $requests->with($withs);
        }
        return $requests
                    ->join($pivot_table,$pivot_table.'.'.$foreign_key_in_related,'=',$table.'.'.$foreign_key_in_related)
                    ->where($foreign_key_in_through,$this->id);
                
                    
        
    }

    public function requests($from = null,$to=null) {
        $categories = $this->categories()->get(['categories.id'])->pluck('id')->all();
        $self = $this;
        $requests = QuotesRequest::with(['quote','client','category.companies'])
            ->whereDoesntHave('dismissed',function($query) use ($self) {
                $query->where('uid','=',$self->id);
            })
            ->whereIn('category_id',$categories)
            ->where('state',$this->state)
            ->whereIn('vicinity_id',[0,$this->vicinity_id]);
            if(!is_null($from) && !is_null($to))
                $requests->whereBetween('created_at',[$from,$to]);
            $requests = $requests->get();
        
        return $requests->filter(function($request) use ($self) {
            if($request->only_to === null ) 
                return true;
            $only_to = (array)json_decode($request->only_to);
            $search = array_search($self->id,$only_to);
            return $search !== false ? true : false;
        });
    }

    public function clientBudgetAverageLast6Months() {
        $from = \Carbon\Carbon::today()->subMonths(6)->toDateTimeString();
        $to = \Carbon\Carbon::today()->toDateTimeString();
        return $this->requests($from,$to)->groupBy(function($item,$key){
            return $item['created_at']->format('M').'_'.$item['created_at']->format('Y').'_'.$item->category->name; 
        })->map(function($item,$key){
            return [$key => [
                    'category' => $item->pluck('category')->first()->name,
                    'request' => $item->pluck('request')
                ]
            ];
        })->flatmap(function($item){
            return $item;
        });
    }

    public function categoryRequestCount() {
        return $this->categories()->with(['requests'=>function($query) {
            $query->where('state',$this->state)->whereIn('vicinity_id',[0,$this->vicinity_id])
            ->where('created_at','>',$this->created_at)
            ->with(['dismissed'=>function($query){
                $query->where('uid',$this->id);
            }]);
        }])->get()->map(function($item,$key){
            return [$item->name => [
                  'total requests' => $item->requests->filter(function($request){
                      $dimissed_count = $request->dismissed->count();
                      if(is_null($request->only_to) && $dimissed_count === 0)
                        return true;
                      elseif(!is_null($request->only_to)) {
                        $only_tos = (array)json_decode($request->only_to);
                        $searched = array_search($this->id,$only_tos);
                        return $searched !== false && $dimissed_count === 0 ? true : false;
                      }
                  })->count(),
                  'answered requests' => $item->requests->filter(function($request){
                     if(is_null($request->only_to) && $request->quote->count() > 0)
                      return true;
                     elseif(!is_null($request->only_to)) {
                       $only_tos = (array)json_decode($request->only_to);
                       $searched = array_search($this->id,$only_tos);
                       return $searched !== false && $request->dismissed->count() === 0 && $request->quote->count() > 0 ? true : false;
                    }
                  })->count(),
                  'Dismissed' => $item->requests->reject(function($request){
                    return $request->dismissed->count() === 0;
                  })->count()
                ]
            ];
        })->flatMap(function($item) {
            return $item;
        })->toArray();
    }

    public function dismissedRequest() {
        $request_model = app('App\Entities\QuotesRequest');
        return $this->hasMany('App\Entities\DismissedRequest','uid');
    }

    public function galleries(){

        return $this->hasMany('App\Entities\Gallery');
    }

    public function getDescriptionAttribute($value){

        return  html_entity_decode($value);
    }

    public function getCompanyImagePathIsS3Attribute() {
        return str_contains($this->company_image,['http','https']);
    }

    public function reviews(){
        return $this->hasMany('App\Entities\Review','review_for');
    }

    public function vicinity(){
        return $this->belongsTo('App\Entities\Vicinity','vicinity_id');
    }

    public function offday(){
        return $this->hasOne('App\Entities\OffDays','user_id');
    }

    public function getRouteKeyName(){
        return 'name_slug';
    }

    public function hasGalleries(){
        return $this->galleries()->count() > 0;
    }

    public function scopeAvailable($query) {

        return $query->leftJoin('offdays','offdays.user_id','=',$this->getTable().'.'.$this->getKeyName())
                ->whereDate('offdays.to_date','<',date('Y-m-d'))
                ->orWhereNull('offdays.to_date');
    }

    public function scopeStateVicinity($query,$state = null,$vicinity = null) {

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

    public function templates() {
        return $this->hasMany('App\Entites\Template','company_id');
    }

    public function medianScore() {
        return $this->reviews()->get()->median('rating');
    }
}

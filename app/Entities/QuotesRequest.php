<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class QuotesRequest extends Model
{
    //

    protected $table = 'quotes_request';

    protected $fillable = [
        'category_id',
        'client_id',
        'state',
        'vicinity_id',
        'request',
        'created_at',
        'updated_at',
        'count_available_vendors'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function quote(){
        return $this->hasMany(Quote::class,'rid')->with(['vendor'=>function($query){
            $query->where('companies.id','!=',request()->user()->id);
        }]);
    }

    public function publicQuote() {
        return $this->quote()->where('public','yes');
    }

    public function dismissed() {
        return $this->hasMany(DismissedRequest::class,'rid');
    }

    public function privateQuote() {
        return $this->quote()->where('public','no');
    }

    public function client() {
        return $this->belongsTo('App\Entities\Customer','client_id');
    }
}
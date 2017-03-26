<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Service\Service;
use App\Entities\Category;
use App\Entities\Review;

class CustomerController extends Controller
{
    //

    private $auth;
    private $amazon_path;
    

    public function __construct(){

        $this->auth = Auth::guard('client');
        //$this->amazon_path = Storage::url('public/images');
        $this->amazon_path = asset('storage/images');
    }

    public function home(){

        return view('customer.home')->with([
            'requests'=>$this->getRequests(),
            'quotes'=>$this->getClientQuotes(),
            'cats'=>Category::all(),
            'reviews'=>$this->getReviews(),
            'formatter'=>Service::currencyFormatter()
        ]);
    }

    private function getRequests(){

        $d = DB::select(DB::raw(
            "select DISTINCT(quotes_request.id),count(distinct(quotes.id)) as replies,
            categories.name as cat_name,quotes.rid as rid,
            quotes_request.request from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id 
            and companies.state = quotes_request.state 
            inner join categories on categories.id = company_category.category_id
            left join quotes on quotes.rid = quotes_request.id
            inner join users on users.id =quotes_request.client_id 
            where quotes_request.client_id = :customer_id
            group by quotes_request.id"
        ),array('customer_id'=>$this->auth->id()));

        return collect($d);
    }

    private function getAnsweredRequests(){
        $d = DB::select(DB::raw(
            "select DISTINCT(quotes_request.id),count(distinct(quotes.id)) as replies,categories.name as cat_name,quotes_request.request from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id 
            and companies.state = quotes_request.state 
            inner join categories on categories.id = company_category.category_id
            left join quotes on quotes.rid = quotes_request.id
            inner join users on users.id =quotes_request.client_id 
            where quotes_request.client_id = :customer_id
            group by quotes_request.id having replies > 0"
        ),array('customer_id'=>$this->auth->id()));

        return collect($d);
    }

    private function getClientQuotes(){

        $d = DB::table('quotes')->join('quotes_request','quotes.rid','=','quotes_request.id')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('companies','companies.id','=','quotes.uid')
                ->join('users','users.id','=','quotes.client_id')
                ->select('quotes.*','quotes_request.request as qrequest','categories.name as cat_name','users.first_name as fname'
                    ,'users.last_name as lname'
                )
                ->where('quotes.client_id',$this->auth->id())->get();
        return collect($d);
    }

    private function getQuotes($request_id){
        $d = DB::table('quotes')->join('quotes_request','quotes.rid','=','quotes_request.id')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('companies','companies.id','=','quotes.uid')
                ->join('users','users.id','=','quotes.client_id')
                ->leftJoin('reviews','reviews.review_for','=','companies.id')
                ->leftJoin('galleries','galleries.user_id','=','quotes.uid')
                ->select('quotes.*','quotes_request.request as qrequest','categories.name as cat_name',
                        'reviews.review','reviews.reply','reviewers_name','rating','image_name',
                         'companies.*',(DB::raw("(select avg(r.rating) from reviews r where r.review_for = companies.id) as avg")),
                         (DB::raw("(select count(r.rating) from reviews r where r.review_for = companies.id) as count")
                         )
                )
                ->where(['quotes.client_id'=>$this->auth->id(),'quotes.rid'=>$request_id])->get();
                //dd(json_encode($d->groupBy('id')[13]->unique()->pluck('image_name')->all()));
                 return Service::paginate($d->groupBy('id'),10);
    }

    private function getReviews(){
        return Review::where('reviewers_email',Auth::guard('client')->user()->email)->get();
    }

    public function showQuotes($request_id = null){
        $d = $this->getQuotes($request_id);
        return view('customer.cuquote')->with(['quotes'=>$d,'amazon_path'=>$this->amazon_path]);
    }

    public function contactVendor(Request $request){
        
    }
    
}

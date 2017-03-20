<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Service\Service;
use App\Entities\Customer;
use App\Entities\User;
use App\Entities\Review;
use App\Entities\QuotesRequest;
use Illuminate\Support\Facades\DB;
use App\TreeNode\CategoryTree;
use App\Events\NewRequestSentEvent;

use App\Mail\SendRequest;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $com;

    public function __construct()
    {
        //Nothing H
        $this->com = '';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $companies = Service::getFiveCompanies();
        return view('landing')->with(['companies'=>$companies]);
    }

    public function writeReview(Request $request){
        
        Review::create($request->except(['_token']));
        return back();
    }


    public function quotesRequest(Request $request){

        $users = null; $customer= null;



        $state = $request->state;
        $vicinity = $request->vicinity;
        $client = $request->only(['first_name','last_name','email','password']);
        $category = $request->only(['category']);

        $request = $request->except(['category','firstname','lastname','email','password','_token','state','vicinity']);

        
        DB::transaction(function() use ($request,$client,$category,$state,$vicinity){

            $users = User::whereHas('categories',function($q) use ($category){
                    $q->where('categories.id',$category['category']);
                })->StateVicinity($state,$vicinity)->get();

            if(!empty($users)){

                    $id = null; $customer = null;
                    if(Auth::guard('client')->check()){
                        $id = Auth::guard('client')->id();
                    }
                    else{

                        $customer = Customer::firstOrCreate([
                                        'first_name'=>$client['first_name'],
                                        'last_name'=>$client['last_name'],
                                        'email'=>$client['email'],
                                        'password'=>bcrypt($client['password'])
                                    ]);

                    }
                    $request = QuotesRequest::create([
                        'category_id'=>$category['category'],
                        'client_id'=>$id !== null ? $id:$customer->id,
                        'state'=>$state,
                        'vicinity_id'=>$vicinity,
                        'request'=>json_encode($request)
                    ]);

                $data = [

                    'users_data'=>$users,
                    'request'=>json_decode($request->request),
                    'category'=>$category['category'],
                    'customer'=>$customer
                ];

                event(new NewRequestSentEvent($data));

            }

            else{

                return json_decode([

                    'message'=>'No Vendors Avalibale'
                ]);
            }
            
      });
    
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Service;
use App\Entities\Customer;
use App\Entities\Review;
use App\Entities\QuotesRequest;
use Illuminate\Support\Facades\DB;
use App\TreeNode\CategoryTree;

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

        
        Review::create($request->all());
        return back()->with('search_url',$request->search_url);
    }


    public function quotesRequest(Request $request){
        
        $client = $request->only(['first_name','last_name','email','password']);
        $category = $request->only(['category']);
        $request = $request->except(['category','firstname','lastname','email','password','_token']);
        dd($request);
        /*$customer = Customer::create([
            'firstname'=>$client->first_name,
            'lastname'=>$client->last_name,
            'email'=>$client->email,
            'password'=>bcrypt($client->password)
        ]);*/
    
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Category;
use App\Service\Service;
use App\Entities\User;
use App\Entities\Review;
use Illuminate\Support\Facades\DB;
use App\TreeNode\CategoryTree;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd($this->test());
        $companies = Service::getFiveCompanies();
        return view('landing')->with(['companies'=>$companies]);
    }

    public function writeReview(Request $request){

        
        Review::create($request->all());
        return back()->with('search_url',$request->search_url);
    }


    public function quotesRequest(Request $request){

        dd(json_encode($request->all()));
    }

    public function test(){

        $d = DB::select(DB::raw(
            "select quotes_request.*,quotes.rid as rid,company_category.company_id, company_category.category_id from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id and companies.state = quotes_request.state 
            and (companies.vicinity_id = quotes_request.vicinity_id or quotes_request.vicinity_id = 0 ) 
            left join quotes on quotes.rid=quotes_request.id where companies.id =:user_id"
        ),array('user_id'=>Auth::id()));
        
        return $d;
    }
}

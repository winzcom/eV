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

        dd(json_encode($request->all()));
    }

    public function test(){

    }
}

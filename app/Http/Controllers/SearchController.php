<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Service\Service;
use App\User;

class SearchController extends Controller
{
    //

    public function search(Request $request){

        //dd($request->query->all());
        $categories = implode(',',$request->query('category'));
        $companies = User::with('reviews')->whereHas('categories',function($q) use ($request){
            $q->whereIn('categories.id',$request->input('category'));
        })->StateVicinity($request->state,$request->vicinity)->where('name','!=','null')->paginate(15);
       return view('app_view.display_list')->with(['companies'=>$companies,'request'=>$request,
                    'categories'=>$categories,
        'events'=>Service::getEvents()
       ]);
    }

    public function search_by_typing(Request $request){
        $name = $request->name;
        $companies = User::with('categories','reviews')->where('name','like',$name."%")->paginate(10);
        return view('app_view.display_list')->with(['companies'=>$companies,'request'=>$request,
            'events'=>Service::getEvents()
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

use App\Category;
use App\Service\Service;
use App\Entities\User;
use App\Repo\Interfaces\UserRepoInterface as UPI;
use App\Interfaces\GalleryInterface as GI;

class SearchController extends Controller
{
    //

    private $path;
    private $user_repo;

    public function __construct(UPI $user_repo,GI $gi){
        $this->path = $gi->directoryPath();
        $this->user_repo = $user_repo;
    }

    public function search(Request $request){

        $categories = implode(',',$request->query('category'));
        $companies = User::with('reviews')->whereHas('categories',function($q) use ($request){
            $q->whereIn('categories.id',$request->input('category'));
        })->StateVicinity($request->state,$request->vicinity)->where('name','!=','null')->paginate(15);
       /*return view('app_view.browsevendors')->with(['companies'=>$companies,'request'=>$request,
                    'categories'=>$categories,
        'events'=>Service::getEvents()
       ]);*/
       return $companies;
    }

    private function getVendors($cat,$state = ''){
        $companies = User::with('reviews','galleries','bay_average')->whereHas('categories',function($q) use ($cat){
            $q->where('categories.id',$cat);
        });
        $state !== '' ? $companies = $companies->StateVicinity($state,'') : $companies;
        $companies = $companies->where('password','!=','')->where('password','!=',null)->paginate(15);
       return $companies;
    }

    public function browseByCategory($category = null, $state = '', Request $request){
        if($category){
            // $companies = Cache::remember(url()->current(),1440,function() use ($category){
            //                 return $this->getVendors($category);
            //             });
            
            $companies = $this->getVendors($category,$state);

            if(count($companies) > 0){
                return view('app_view.vendorbrowse')->with([
                    'companies'=>$companies,
                    'category_id'=>$category,
                    'path'=>$this->path,
                    'cat_name'=>$companies->first()->categories->find($category)->name,
                    'cur_state'=> $state
                ]);
            }
            //return view('app_view.vendorbrowse')->with('category_id',$category);
        }
        return view('app_view.vendorbrowse')->with(['category_id'=>$category,'cur_state'=> $state]);   
        
    }


    public function search_by_typing(Request $request){
        $name = $request->name;
        $companies = User::with('categories','reviews')->where('name','like',$name."%")->paginate(10);
        return view('app_view.display_list')->with(['companies'=>$companies,'request'=>$request,
            'events'=>Service::getEvents()
        ]);
    }
}

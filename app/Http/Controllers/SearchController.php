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
        })->StateVicinity($request->state,$request->vicinity)->where('name','!=',null)->paginate(15);
       /*return view('app_view.browsevendors')->with(['companies'=>$companies,'request'=>$request,
                    'categories'=>$categories,
        'events'=>Service::getEvents()
       ]);*/
       return $companies;
    }

    private function getVendors($cat,$state = null){
        $companies = User::with('reviews','galleries','bay_average','categories')->whereHas('categories',function($q) use ($cat){
            $q->where('categories.id',$cat);
        });
        $state !== null ? $companies = $companies->StateVicinity($state,'') : $companies;
        //$companies = $companies->where('password','!=','')->where('password','!=',null)->paginate(15);
       return $companies->where('bounced',0)->where('name_slug','!=',null)->paginate(15);
    }

    public function browseByCategory($category = null, $state = '', Request $request){
        if($category){
            $companies = $this->getVendors($category,$state);

            if(count($companies) > 0){
                
                return !request()->ajax() ? view('app_view.vendorbrowse')->with([
                    'companies'=>$companies,
                    'category_id'=>$category,
                    'path'=>$this->path,
                    'cat_name'=>$companies->first()->categories->find($category)->name,
                    'cur_state'=> $state
                ]) : $companies;
            }
            //return view('app_view.vendorbrowse')->with('category_id',$category);
        }
        return !request()->ajax() ? view('app_view.vendorbrowse')->with(['category_id'=>$category,'cur_state'=> $state]) : response()->json([
            'message' => 'Please Pick a category'
        ]);   
        
    }


    public function search_by_typing(Request $request){
        $name = $request->term;
        $companies = User::with('categories','reviews')->where('name','like',$name."%");
        if($request->ajax()) 
            return $companies->get()->filter(function($company) {
                $name_slug = $company->name_slug;
                $count = count($company->categories);
                if($name_slug !== null && $name_slug !== '' && $count > 0)
                    return true;
            })->map(function($company) {
                return [
                        'value' => $company->name,'label' => $company->name,
                        'slug' => $company->name_slug,
                        'cat_id' => $company->categories->first()->id 
                    ];
                });
        $companies = $companies->paginate(10);
        return view('app_view.display_list')->with(['companies'=>$companies,'request'=>$request,
            'events'=>Service::getEvents()
        ]);
    }
}

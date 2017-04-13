<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


use App\Entities\User;
use App\Service\Service;
use App\Repo\Interfaces\UserRepoInterface as UPI;

class DetailsController extends Controller
{
    //
    public $request;

    public function __construct(Request $request,UPI $user_repo){
        $this->request = $request;
       $this->path = Storage::url('public');
    }

    public function details($slug,$id=null){

        $user = User::with(
            [
                'reviews'=>function($q){
                    $q->orderBy('id','desc');
                },
                'galleries'
            ]
        )->where('name_slug',$slug)->first();

        $category_name = '';

        $similars = User::whereHas('categories',function($q) use ($user){
            $q->whereIn('categories.id',$user->categories()->pluck('categories.id'));
        })->where('id','!=',$user->id)->orderBy('id','desc')->take(3)->get();

        if(!is_null($id)){
            $category_name = $user->categories->find($id)->name;
            $cat_id = $user->categories->find($id)->id; 
        }
            
        
       // $directory = public_path("storage".DIRECTORY_SEPARATOR."images");
        //$files = Service::getImages($directory);
        return view('app_view.details')->with(['company'=>$user,'path'=>$this->path,
                    'events'=>Service::getEvents(),
                    'similars'=>$similars,
                    'request'=>$this->request,
                    'cat_id'=>isset($cat_id) ? $cat_id : '',
                    'avg'=>$user->reviews->pluck('rating')->avg(),
                    'category_name'=>$category_name
                ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


use App\Entities\User;
use App\Service\Service;
use App\Repo\Interfaces\UserRepoInterface as UPI;
use App\Interfaces\GalleryInterface as GI;

class DetailsController extends Controller
{
    //
    public $request;

    public function __construct(Request $request,UPI $user_repo,GI $gi){
        $this->request = $request;
       $this->path = $gi->directoryPath();
    }

    public function details($slug,$id=null){

        $user = User::with(
            [
                'reviews'=>function($q){
                    $q->orderBy('id','desc');
                },
                'categories',
                'galleries'
            ]
        )->where('name_slug',$slug)->first();
       
        $category_name = ''; $cat_id = null;

        $similars = User::whereHas('categories',function($q) use ($user){
            $q->whereIn('categories.id',$user->categories()->get(['categories.id']));
        })->where('id','!=',$user->id)->orderBy('id','desc')->take(3)->get();

        if(!is_null($id)){
            $category = $user->categories->find($id);
            $category_name = $category->name;
            $cat_id = $category->id; 
        }else {
            $category = $user->categories->first();
            $category_name = $category->name;
            $cat_id = $category->id;
        }

        $data = [ 
                    'company'=>$user,'path'=>$this->path,
                   'events'=>Service::getEvents(),
                    //'similars'=>$similars,
                    'request'=>$this->request,
                    'cat_id'=>isset($cat_id) ? $cat_id : '',
                    'avg'=>$user->reviews->pluck('rating')->avg(),
                    'category_name'=>$category_name
                ];
        $review_form_data = [
            'reviewers_name'=>request()->user('client') !== null ? request()->user('client')->full_name : '',
            'reviewers_email'=>request()->user('client') !== null ? request()->user('client')->email : '',
            'review_for'=>$user->id
        ];
        
       // $directory = public_path("storage".DIRECTORY_SEPARATOR."images");
        //$files = Service::getImages($directory);
        return view('app_view.details')->with($data)
                    ->nest('request_form','app_view.requestForm.requestform',
                        ['category_id'=>$cat_id,'show_only_this_vendor_option' => true,'user_id' => $user->id]
                    )->nest('review_form','app_view.requestForm.review_form',$review_form_data);
    }
}

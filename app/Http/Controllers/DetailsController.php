<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use App\Service\Service;

class DetailsController extends Controller
{
    //
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
        $this->path = asset('storage/images/');
    }

    public function details($slug,$id=null){

        $user = User::with(['reviews'=>function($q){
                    $q->orderBy('id','desc');
        }])->where('name_slug',$slug)->first();

        $category_name = '';

        $similars = User::whereHas('categories',function($q) use ($user){
            $q->whereIn('categories.id',$user->categories()->pluck('categories.id'));
        })->where('id','!=',$user->id)->orderBy('id','desc')->take(3)->get();

        if(!is_null($id)){
            $cat_id = $id;
            $category_name = $user->categories()->where('categories.id',$id)->first()->name;
        }
        
       // $directory = public_path("storage".DIRECTORY_SEPARATOR."images");
        //$files = Service::getImages($directory);
        return view('app_view.details')->with(['company'=>$user,'path'=>$this->path,
                    'events'=>Service::getEvents(),
                    'similars'=>$similars,
                    'request'=>$this->request,
                    'cat_id'=>$id != null ? $id:null,
                    'category_name'=>$id!=null ? $user->categories()->where('categories.id',$id)->first()->name:''
                ]);
    }
}

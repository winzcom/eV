<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Service\Service;

class DetailsController extends Controller
{
    //
    public $request;

    public function __construct(Request $request){
        $this->request = $request;
        $this->path = asset('storage/images/');
    }

    public function details($slug){

        $user = User::with(['reviews'=>function($q){
                    $q->orderBy('id','desc');
        }])->where('name_slug',$slug)->first();

        $similars = User::whereHas('categories',function($q) use ($user){
            $q->whereIn('categories.id',$user->categories()->pluck('categories.id'));
        })->where('id','!=',$user->id)->orderBy('id','desc')->take(3)->get();

        
       // $directory = public_path("storage".DIRECTORY_SEPARATOR."images");
        //$files = Service::getImages($directory);
        return view('app_view.item')->with(['userd'=>$user,'path'=>$this->path,
                    'events'=>Service::getEvents(),
                    'similars'=>$similars,
                    'request'=>$this->request]);
    }
}

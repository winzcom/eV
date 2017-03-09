<?php

namespace App\Http\Controllers\CustomerAuth;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;

use Illuminate\Hashing\BcryptHasher;

use App\Http\Controllers\Controller;

class CustomerAuthController extends Controller
{
    private $redirect = '/cuhome';
    public function __construct(){

    }

    public function register(){

    }

    public function login(Request $request){

        $this->validate($request,[
            'email'=>'bail|required',
            'password'=>'required'
        ]);

        if(Auth::guard('client')->attempt(['email'=>$request->email,'password'=>$request->password])){
            
        }
        
    }

    public function showLoginForm(){

        return view('client.login');
    }
    
}

<?php

namespace App\Http\Controllers\Customer;

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
        $this->middleware('guest.client:client');
    }

    public function register(){
        
    }

    public function login(Request $request){

        $this->validate($request,[
            'email'=>'bail|required',
            'password'=>'required'
        ]);

        if(Auth::guard('client')->attempt($request->only(['email','password']))){
            return redirect($this->redirect);
        }
        else return redirect('/culogin');
        
    }

    public function showLoginForm(){

        return view('customer.login');
    }

    
}

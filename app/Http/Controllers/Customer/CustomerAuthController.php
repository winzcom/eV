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
        ],$this->messages());

        if(Auth::guard('client')->attempt($request->only(['email','password']))){
            if($request->redirectUrl !== null) {
                return redirect($request->redirectUrl);
            }
            return redirect($this->redirect);
        }
        else return redirect('/culogin')
                    ->withInput($request->only('email','remember'))
                    ->withErrors(['email'=>'These credentials do not match our records.']);
        
    }

    public function showLoginForm(){
        $referer = null;
        if(request()->headers->get('referer')!== null) {
            if(strpos(request()->headers->get('referer'),'detail') !== false) {
                $referer = request()->headers->get('referer');
            }
        }
        return view('customer.login')->with('redirectUrl',$referer);
    }

    protected function messages(){
        return [
            'email.required'=>'Email field is required',
            'password.required'=>'Password is required'
        ];
    }
}

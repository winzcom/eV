<?php

namespace App\Http\Controllers\Auth;

use App\Entities\User;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendVerificationMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\FormRegistration;;
use App\Service\Service;
use App\Repo\Interfaces\UserRepoInterface as UPI;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
     
    private $user_repo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UPI $user_repo)
    {
        $this->middleware('guest');
        $this->user_repo = $user_repo;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data,[
            'name'=>'required|unique:companies',
            'email'=>'required|email|unique:companies',
            'password'=>'required|confirmed'
        ],$this->messages());
    }

    public function register(Request $request){

        $validator = $this->validator($request->all());

        if($validator->fails()){
            return redirect('/register')
                    ->withErrors($validator)
                    ->withInput();
        }

        DB::Transaction(function() use ($request){
                event(new Registered($user = $this->create($request->all())));
        },5);

        return redirect('login')->with('message','A verification email has been sent');
        
    }

    /*protected function redirectTo(){
        return redirect('/login')->with('status','An Email has been sent to You');
    }*/

    private function sendVerificationMail($user){

        try{
            Mail::to($user->email)
                ->send(new SendVerificationMail($user));
        }catch(\Swift_TransportException $e){

        }
    }

    private function generateToken(){
        return str_random(40);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = $this->user_repo->createNewUser($data);
        $user->confirm_token = $this->generateToken();
        $user->save();
        //$this->sendVerificationMail($user);
        return $user;
    }

    public function verifyToken($confirm_token){

        $user = $this->user_repo->findFirstByWhere(['confirm_token','=',$confirm_token]);

        if(!$user) throw new \Exception;

        $user->confirm_token = null;
        $user->confirmed = 1;
        $user->save();
        return redirect('login')->with('message','Please Login');
        //$this->guard()->login($user);
    }

    public function messages()
    {
        return [
            'name.required' => 'A Company Name is required',
            'email.required'  => 'An Email is required',
            'password.required'=>'A password is required',
            'password.confirmed'=>'Both Password And Password Confirmation must Match'
        ];
    }
}

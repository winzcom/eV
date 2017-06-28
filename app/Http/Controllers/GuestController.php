<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Aws\Sns\SnsClient;
use App\Service\Service;
use App\Mail\SendVerificationMail;
use App\Mail\EmailTypeVerification;
use Illuminate\Support\Facades\DB;

use App\Repo\Interfaces\UserRepoInterface as UPI;
use App\Events\NewRequestSentEvent;

use App\Mail\SendRequest;

class GuestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     private $userRepo;

    public function __construct(UPI $userRepo)
    {
        
        $this->userRepo = $userRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = [];
        $state = session('user_state') ? session('user_state'):null;
        if($state == "" || $state == null){
             try{
                    $state = json_decode(file_get_contents('http://freegeoip.net/json/'))->region_name;
                    session(['user_state'=>$state]);
                }catch(\ErrorException $e){
                    $companies = [];
                }
            
        }else $companies = $this->userRepo->getTopVendors($state);
        //$some_quotes = $this->userRepo->getSomeRequestsAndAverage($state);
        return view('landing',compact('companies'));
    }

    public function writeReview(Request $request){
        
        $data = $request->except(['_token']);
        $data['reviewers_id'] = Auth::guard('client')->id();
        $this->userRepo->createModel('reviews')
            ->create($data);
        return back();
    }

    public function testLoad(){

        return $this->userRepo->getRequests();
    }

    private function getUserQuery($category,$state,$vicinity){

        return $this->userRepo->getModel()->whereHas('categories',function($q) use ($category){
                    $q->where('categories.id',$category['category']);
                })->StateVicinity($state,$vicinity);
    }

    public function quotesRequest(Request $request){

        $users = null; $customer= null;
        $state = $request->state;
        $vicinity = $request->vicinity;
        $client = $request->only(['first_name','last_name','email','password']);
        $category = $request->only(['category']);
        $request = $request->except(['category','firstname','','lastname','email','password','_token','state','vicinity']);

        
        DB::transaction(function() use ($request,$client,$category,$state,$vicinity){

            $users = $this->getUserQuery($category,$state,$vicinity)->get();
            $customer = null;
            
            if(!empty($users)){

                    $id = null; $customer = null;
                    if(Auth::guard('client')->check()){
                        $id = Auth::guard('client')->id();
                        $customer = Auth::guard('client')->user();
                    }
                    else{
                            if(!Service::isValid($client)){
                                   echo json_encode(['error'=>'Please fill your personal details']);  
                                   return;
                            }
                                
                            try{
                                    $customer = $this->userRepo->createModel('customer')->firstOrCreate([
                                                'first_name'=>$client['first_name'],
                                                'last_name'=>$client['last_name'],
                                                'email'=>$client['email'],
                                                'password'=>bcrypt($client['password'])
                                            ]);

                            }catch(\Exception $e){
                                echo json_encode(['error'=>'An error occured. Please try again']);
                                return;
                            }
                            
                    }
                    if($vicinity == 'all' || $vicinity == '') $vicinity = 0;

                    try{
                            $request = $this->userRepo->createModel('quotes_request')->create([
                            'category_id'=>$category['category'],
                            'client_id'=>$id !== null ? $id:$customer->id,
                            'count_available_vendors'=>count($users),
                            'state'=>$state,
                            'vicinity_id'=>$vicinity,
                            'request'=>json_encode($request)
                        ]);
                    }catch(\Exception $e){
                        $customer->delete();
                        echo json_encode(['error'=>'An error occured in creating your request. Please try again']);
                        return;
                    }
                    

                $data = [

                    'users_data'=>$users,
                    'request'=>json_decode($request->request),
                    'category'=>$category['category'],
                    'customer'=>$customer
                ];

                event(new NewRequestSentEvent($data));

                echo json_encode(['message'=>'Request Sent']);
                return;
            }

            else{

                
                return response()->json([
                    'message'=>'No Vendors Available we will try and get for this search query'
                ]);
            }
            
      });
    
    }

    public function checkVendorAvailability(Request $request){

        //dd($request->all());
        $category = $request->only(['category']);
        $available = $this->getUserQuery($category,$request->state,$request->locality)->count();
        if($available == 0) {
            $request->locality = $request->locality == 'all' ? 0 : $request->locality;
            DB::table('no_vendor_log')->insert(
                ['category_id' => $request->category, 'state' => $request->state, 'vicinity_id' => $request->locality]
            );
        }
        return response()->json([
            'available'=>$available
        ]);
    }

    public function logout(){
        if(Auth::check()){
            Auth::logout();
            return redirect('/login');
        }
        elseif(Auth::guard('client')->check()){
            Auth::guard('client')->logout();
            return redirect('/culogin');
        }
    }

    public function verifyVendorByEmail($email = null) {
        /*$count = $this->userRepo->getModel()->where('email',$email)->count();
        if($count > 0) {
            $randomString = str_random(40);
            return redirect("password/create?s=".$randomString)->with('email',$email);
        }*/
        $randomString = str_random(40);
        return redirect("password/show?s=".$randomString)->with('email','ebudare@yahoo.com');
    }

    public function sendEmailTypeVerificationMail() {
        //$users = $this->userRepo->getModel()->where('confirmed', 0);

        Mail::to('ebun68@gmail.com')->send(new EmailTypeVerification());
    }

    public function showPasswordCreate(Request $request) {
        if(!$request->has('s'))
            return redirect('/login');
        return view('app_view.showpasswordcreate')->with('email',$request->s);
    }

    public function createPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|exists:companies|max:255',
            'password' => 'required|confirmed',
        ]);

        $model = $this->userRepo->getModel()->where('email',$request->email)->first();
        $model->name_slug = str_slug($model->company_name,'_');
        $model->password = bcrypt($request->password);
        $model->confirmed = 1;
        $model->save();

        return redirect('login');
    }

    public function setFirebaseNotificationEndPoint(Request $request){
        $model = null;
        if(Auth::check()){
            $model = $this->userRepo->getModel();
            $model->where('id',Auth::id())->update(['firebase_endpoint'=>$request->token]);
        }
        elseif(Auth::guard('client')->check()){
            $model = $this->userRepo->createModel('customer');
            $model->where('id',Auth::guard('client')->id())->update(['firebase_endpoint'=>$request->token]);
        }
    }

    public function amazonSnS(){
        $sns_client = new SnsClient(['region'=>env('AWS_REGION'),'version'=>'2010-03-31',
            'credentials'=>[
                'secret'=>env('AWS_SECRET'),
                'key'=>env('AWS_KEY'),
            ]
        ]);

        $json = json_decode(file_get_contents("php://input"),true);
        try{
            if(isset($json['Type'])){
                if($json['Type'] === 'SubscriptionConfirmation'){
                    $result = $sns_client->confirmSubscription(['Token'=>$json['Token'],'TopicArn'=>$json['TopicArn']]);
                }elseif($json->Type === 'Notification'){

                }
            }elseif(isset($json['notificationType']) && $json['notificationType'] === 'Bounce'){
                $bounced_recipient = $json['bouncedRecipients'];
                //Loop through and set a flag on vendors email;
                if(count($bounced_recipient) > 0){
                    $emails = [];
                    foreach($bounced_recipient as $obj){
                        $emails[] = $obj->email;
                    }
                    DB::table('companies')->whereIn('email',$emails)
                            ->update(['bounced'=>'1']);
                }
            }
        }catch(\Exception $e){
                    
        }

    }
}

?>

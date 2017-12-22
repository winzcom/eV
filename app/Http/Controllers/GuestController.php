<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\FilesystemManager;
use Aws\S3\S3Client;

use Aws\Sns\SnsClient;
use App\Service\Service;
use GuzzleHttp\Client;
use App\Mail\SendVerificationMail;
use App\Mail\ThankYouMail;
use App\Mail\EmailTypeVerification;
use Illuminate\Support\Facades\DB;
use App\Entities\User;
use App\Entities\Customer;
use App\Entities\Review;
use App\Entities\QuotesRequest;

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

     private $uRepo;

    public function __construct(UPI $uRepo,FilesystemManager $laravelStorage, S3Client $s3Client)
    {
        parent::__constructor($laravelStorage,$s3Client);
        $this->uRepo = $uRepo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = []; $state = null;
        
        if(session('user_state') == null){
            try {
                // $client = new Client(['base_uri'=>'http://freegeoip.net']);
                // $response = $client->request('GET','json');
                // $state = json_decode($response->getBody()->getContents())->region_name;
                // session(['user_state'=>$state]);
                // $companies = $this->uRepo->getTopVendors($state);
            }catch(Exception $e) {
                $companies = [];
            }
                
            return view('landing')->with(['companies'=>$companies,'state'=>$state]);
            
        }
            $state = session('user_state');
            $companies = $this->uRepo->getTopVendors($state);
            return view('landing')->with(['companies'=>$companies,'state'=>$state]);
        //$some_quotes = $this->uRepo->getSomeRequestsAndAverage($state)
    }

    public function writeReview(Request $request){
        
        $data = $request->except(['_token','review_pictures']);
        $data['reviewers_id'] = Auth::guard('client')->id();
        if( $request->hasFile('review_pictures') ) {
            $filePaths = $this->uploadFiles('', $request->review_pictures, 'public/review_images');
            $data['review_image'] = json_encode($filePaths);
        }
           
        Review::forceCreate($data);
        if($request->ajax())
            return $this->success(['status' => 'success']);
        return redirect()->back();
    }

    public function testLoad(){

        return $this->uRepo->getRequests();
    }

    private function getUserQuery($category,$state,$vicinity){

        return $this->uRepo->getUserQuery($category,$state,$vicinity);
    }

    public function quotesRequest(Request $request){
        $users = null; $customer= null;
        $state = $request->state;
        $vicinity = $request->vicinity;
        $client = $request->only(['first_name','last_name','email','password','phone_no']);
        $category = $request->only(['category']);
        $files = $request->hasFile('request_photo')  ? $request->request_photo : null;
        $request = $request->except(['category','firstname','','lastname','email','password','_token','state','vicinity']);
        
        $request = array_filter($request,function($val,$key){
            return $val !== '' && $val !== null && !empty($val) && $val !== '-';
        },ARRAY_FILTER_USE_BOTH);

        DB::transaction(function() use ($request,$client,$category,$state,$vicinity,$files){
            $users = $this->getUserQuery($category,$state,$vicinity)->get();
            $customer = null;
            
            if(!empty($users)){

                    $id = null; 
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
                                $customer = Customer::where('email',$client['email'])->first();
                                if(!is_null($customer)) {
                                    $customer->password = bcrypt($client['password']);
                                    $customer->first_name = $client['first_name'];
                                    $customer->last_name = $client['last_name'];
                                    $customer->phone_no = $client['phone_no'];
                                    $customer->save();
                                    
                                } else {
                                    $customer = Customer::create([
                                            'first_name'=>$client['first_name'],
                                            'last_name'=>$client['last_name'],
                                            'email'=>$client['email'],
                                            'phone_no'=>$client['phone_no'],
                                            'password'=>bcrypt($client['password'])
                                        ]);
                                }

                            }catch(\Exception $e){
                                echo json_encode(['error'=>'An error occured. Please try again']);
                                return;
                            }
                            
                    }
                    if($vicinity == 'all' || $vicinity == '' || $vicinity == null) $vicinity = 0;

                    try{

                            $req = QuotesRequest::create([
                            'category_id'=>$category['category'],
                            'client_id'=>$id !== null ? $id:$customer->id,
                            'count_available_vendors'=>count($users),
                            'state'=>$state,
                            'vicinity_id'=>$vicinity,
                            'request'=>json_encode($request)
                        ]);
                        if(!is_null($files)) {
                            if( $filePaths = $this->uploadFiles('s3',$files,'public/request_pictures') ) {            
                                $req->file_paths = json_encode($filePaths);
                                $req->save();  
                            }
                        }
                    }catch(\Exception $e){
                        //$req->delete();
                        
                        echo json_encode(['error'=>$e->getMessage()]);
                        return;
                    }
                    

                $data = [

                    'users_data'=>$users,
                    'request'=>json_decode($req->request),
                    'category'=>$category['category'],
                    'customer'=>$customer
                ];
                try {
                    event(new NewRequestSentEvent($data));
                    // $mailer = Mail::to($data['users_data'])
                    // ->send(new SendRequest($data));
                } catch(\Exception $e) {
                    echo json_encode([
                        'status'=>'failed',
                        'message'=>'Notifications could not be sent at this time'
                    ]);
                    return;
                }
                

                // return response()->json([
                //     'message'=>'Request Sent'
                // ]);

                echo json_encode(['message'=>'Request Sent']);
                return;
            }

            else{
                
                return response()->json([
                    'message'=>'No Vendors Available'
                ]);
            }
            
      });
    
    }

    public function checkVendorAvailability(Request $request){

        $category = $request->only(['category']);
        $available = $this->getUserQuery($category,$request->state,$request->locality)->count();
        if($available == 0) {
             $request->locality = $request->locality == 'all' ? 0 : $request->locality;
            
             $no_log = $this->uRepo->getCountNoTimesVendorsNotAvailable();
            if($no_log > 0) 
                $this->uRepo->setNoLogVendorsNotAvailable('increment');
            else{
                 $this->uRepo->setNoLogVendorsNotAvailable();                
            }
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
        /*$count = $this->uRepo->getModel()->where('email',$email)->count();
        if($count > 0) {
            $randomString = str_random(40);
            return redirect("password/create?s=".$randomString)->with('email',$email);
        }*/
        $randomString = str_random(40);
        return redirect("password/show?s=".$randomString)->with('email','ebudare@yahoo.com');
    }

    public function sendEmailTypeVerificationMail() {
        $users = User::where([
            ['confirmed','=',0],['email','!=',''],
            ['bounced','=',0],['email','like','%@gmail.com']
        ])->orWhere([
            ['confirmed','=',0],['email','!=',''],
            ['bounced','=',0],['email','like','%@yahoo.com']
        ]);
        $users->each(function($user,$key) {
           Mail::to($user->email)->send(new EmailTypeVerification($user->name));
        });
    }

    public function showPasswordCreate(Request $request) {
        if(! $request->query('s') )
            return redirect('/login');
        return view('app_view.showpasswordcreate')->with('email',$request->s);
    }

    public function createPassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|exists:companies|max:255',
            'password' => 'required|confirmed',
        ]);

        try {
            $model = User::where('email','=',$request->email)->firstOrFail();
            $model->name_slug = str_slug($model->name,'_');
            $model->password = bcrypt($request->password);
            $model->confirmed = 1;
            $model->save();
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'confirmed'=>1])) {
                return redirect('home');
            }
            return redirect('login');
        } catch(\Exception $e) {
            return redirect('login')->withErrors([
                'email' => 'Email does not exist'
            ]);
        }
    }

    public function setFirebaseNotificationEndPoint(Request $request){
        $model = null;
        if(Auth::check()){
            //$model = $this->uRepo->getModel();
            User::where('id',Auth::id())->update(['firebase_endpoint'=>$request->token]);
        }
        elseif(Auth::guard('client')->check()){
            //$model = $this->uRepo->createModel('customer');
            Customer::where('id',Auth::guard('client')->id())->update(['firebase_endpoint'=>$request->token]);
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
            if(isset($json->Type)){
                if($json->Type === 'SubscriptionConfirmation'){
                    $client = new Client();
                    $res = $client->request('GET',$json->SubscribeURL);
                    // $result = $sns_client->confirmSubscription(['Token'=>$json->Token,'TopicArn'=>$json->TopicArn]);
                }elseif($json->Type === 'Notification'){

                }
            }elseif(isset($json->notificationType) && $json->notificationType === 'Bounce'){
                $bounced_recipient = $json->bouncedRecipients;
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

    public function sendFollowUpThanksMail() {
        $users = User::where('password', '!=', '')
            ->get();
        if($users->isNotEmpty()) {
            $users->each(function($user) {
                Mail::to($user->email)->send(new ThankYouMail($user->name));
            });
        }
    }

    public function SendMailToUsersWithPasswordWithNoState() {
        $users =  User::where('password','!=','')->where('state','')->get();
        if($users->isNotEmpty()) {
            $users->each(function($user) {
                Mail::to($user->email)->send(new PleaseUpdateProfile($user->name));
            });
        }
    }

    public function sendMailToUsersWithoutPasswords() {
        $users_without_passwords = User::where([
            ['password','!=',''],
            ['bounced','=',0]
        ])->orWhere(function($query) {
            $query->where('password',null)
                  ->where('bounced',0);
        })->get();
        if( $users_without_passwords->isNotEmpty() ) {
            $users_without_passwords->each(function($user) {
                Mail::to($user)->send(new \App\Mail\MailToUsersWithoutPassword($user));
            });
        }

        try {
            $first = $users_without_passwords->first();
            if( $first instanceof User ) {
                $dummy_user = $first->newInstance([
                    'email' => 'ebun68@gmail.com',
                    'name' => 'Testing if cron job is running'
                ]);
                Mail::to($dummy_user)->send(new MailToUsersWithoutPassword($dummy_user));
            }
        } catch(\Exception $e) {
            //
        }
    }

    public function setNameSlug() {
        User::where('name_slug','')->orWhere('name_slug',null)
            ->chunk(250,function($users) {
                $users->each(function($user){
                    $user->name_slug = str_slug($user->name,'-');
                    $user->save();
                });
            });
    }
}

?>

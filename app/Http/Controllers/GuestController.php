<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use App\Service\Service;
use App\Entities\User;
use App\Entities\QuotesRequest;
use Illuminate\Support\Facades\DB;
use App\TreeNode\CategoryTree;
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

     private $repo;

    public function __construct(UPI $repo)
    {
        
        $this->repo = $repo;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $companies = Service::getFiveCompanies();
        return view('landing')->with(['companies'=>$companies]);
    }

    public function writeReview(Request $request){
        
        $data = $request->except(['_token']);
        $data['reviewers_id'] = Auth::guard('client')->id();
        $this->repo->createModel('reviews')
            ->create($data);
        return back();
    }

    private function getUserWithCategoryQuery($category,$state,$vicinity){

        return $this->repo->createModel('vendor')->whereHas('categories',function($q) use ($category){
                    $q->where('categories.id',$category['category']);
                })->StateVicinity($state,$vicinity);
    }

    public function quotesRequest(Request $request){

        $users = null; $customer= null;
        $state = $request->state;
        $vicinity = $request->vicinity;
        $client = $request->only(['first_name','last_name','email','password']);
        $category = $request->only(['category']);

        $request = $request->except(['category','firstname','lastname','email','password','_token','state','vicinity']);

        
        DB::transaction(function() use ($request,$client,$category,$state,$vicinity){

            $users = $this->getUserWithCategoryQuery($category,$state,$vicinity)->get();
           
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
                                

                            $customer = $this->repo->createModel('customer')->firstOrCreate([
                                            'first_name'=>$client['first_name'],
                                            'last_name'=>$client['last_name'],
                                            'email'=>$client['email'],
                                            'password'=>bcrypt($client['password'])
                                        ]);

                    }
                    if($vicinity == 'all' || $vicinity == '') $vicinity = 0;
                    $request = $this->repo->createModel('quotes_request')->create([
                        'category_id'=>$category['category'],
                        'client_id'=>$id !== null ? $id:$customer->id,
                        'state'=>$state,
                        'vicinity_id'=>$vicinity,
                        'request'=>json_encode($request)
                    ]);

                $data = [

                    'users_data'=>$users,
                    'request'=>json_decode($request->request),
                    'category'=>$category['category'],
                    'customer'=>$customer
                ];

                event(new NewRequestSentEvent($data));

                echo json_encode(['message'=>'Reply Sent']);
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

        //dd($request->all());
        $category = $request->only(['category']);
        $available = $this->getUserWithCategoryQuery($category,$request->state,$request->locality)->count();
        
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

    public function setFirebaseNotificationEndPoint(Request $request){
        $model = null;
        if(Auth::check()){
            $model = $this->repo->createModel('vendor');
            $model->where('id',Auth::id())->update(['firebase_endpoint'=>$request->token]);
        }
        elseif(Auth::guard('client')->check()){
            $model = $this->repo->createModel('customer');
            $model->where('id',Auth::guard('client')->id())->update(['firebase_endpoint'=>$request->token]);
        }
    }
}

?>

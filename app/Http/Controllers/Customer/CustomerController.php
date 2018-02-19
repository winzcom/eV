<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Service\Service;
use App\Entities\Category;
use App\Entities\Review;
use App\Entities\User;
use App\Entities\QuotesRequest;
use App\Events\ContactVendorEvent;

use App\Repo\Interfaces\CustRepoInterface as CRI;
use App\Repo\Interfaces\UserRepoInterface as URI;
use App\Interfaces\GalleryInterface as GI;

class CustomerController extends Controller
{
    //
    private $auth;
    private $amazon_path;
    private $cust_repo;
    private $user_repo;

    public function __construct(CRI $cust_repo,GI $gi,URI $user_repo){

        $this->auth = Auth::guard('client');
        $this->cust_repo = $cust_repo;
        $this->user_repo = $user_repo;
        $this->path = $gi->directoryPath();
    }

    public function home(){
        list($total_avg,$reviews) = $this->getFiveReviews();
        return view('customer.home')->with([
            'requests'=>$this->getRequests(),
            'quotes'=>$this->getClientQuotes(),
            'cats'=>Category::all(),
            'avg'=>$total_avg[0]->avg,
            'reviews'=>$reviews
        ]);
    }

    private function getRequests(){

        $d =  $this->cust_repo->getRequests($this->auth->id());
        return $d;
    }

    private function getAnsweredRequests(){
        
       return $this->cust_repo->getAnsweredRequests($this->auth->id());
    }

    private function getClientQuotes(){
        return $this->cust_repo->getClientQuotes($this->auth->id());
    }

    private function getRequestQuotes($request_id){
        return $this->cust_repo->getRequestQuotes($this->auth->id(),$request_id);
    }

    private function getFiveReviews(){
        return $this->cust_repo->getReviews($this->auth->id(),null,5,['id','desc']);
    }

    public function showQuotes($request_id = null){
        $d = $this->getRequestQuotes($request_id);
        $quotes = $d->paginate($d->data,10);
        $cost_avg = $d->data->first()->pluck('cost_avg')->first();
        //$users = $d->data->
        return view('customer.cuquote')
                    ->with(['quotes'=>$quotes,
                        'amazon_path'=>$this->path,
                        'cost_avg'=>$cost_avg,
                        'cats'=>Category::all(),
                    ]);
    }

    public function showRequests(){
        $d = $this->getRequests();
        $paginator = $this->cust_repo->paginate($d,2);
        return view('customer.request')->with('client_requests',$paginator);
    }

    public function contactVendor(Request $request){

        $quote = $this->user_repo->createModel('quote')->where(['rid'=>$request->request_id,'uid'=>$request->vendor_id])->first();
        $quote->contact = 1;
        $quote->save();
        //Send Mail to Vendor.
        $vendor = $this->user_repo->find($request->vendor_id);
        $message = $request->message;
        $request = $this->user_repo->getRequest($request->request_id);
       event(new ContactVendorEvent($vendor,request()->user('client'),$request,$message));

        return response()->json([
            'message'=>'Message Sent'
        ]);
    }

    public function getUser() {
        $user = request()->user('client')->load(['self_vendor_chat_channel']);
        $data = [
            'user' => ['id' => $user->id,'name'=>$user->first_name,'email'=>$user->email],
            'vendor' => $user->self_vendor_chat_channel->map(function($item,$key){
                return [
                    'vendor_name' => $item->name,
                    'vendor_id' => $item->id,
                    'vendor_email' => $item->email,
                    'channel_url' => $item->pivot->channel_url 
                ];
            }) 
        ];
        return $this->success($data);
    }
    
    public function addNewChannel($vendor_id,$channel_url) {
        request()->user('client')->self_vendor_chat_channel()->sync([$vendor_id => ['channel_url' => $channel_url]],false); 
        return $this->success([
            'message' => 'added',
        ]);
    }

    public function chatNotification() {
        try {
            $client = \App\Entities\Customer::findOrFail(request()->client_id);
            $client->notify(new \App\Notifications\ChatNotification());
        }catch(\Exception $e) {
            return $this->error([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],500);
        }
    }
}

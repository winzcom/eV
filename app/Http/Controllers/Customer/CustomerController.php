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
        return view('customer.cuquote')->with(['quotes'=>$quotes,
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
       event(new ContactVendorEvent($vendor,Auth::guard('client')->user(),$request,$message));

        return response()->json([
            'message'=>'Message Sent'
        ]);
    }
    
}

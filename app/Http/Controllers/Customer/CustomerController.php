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
        //$this->amazon_path = Storage::url('public/images');
        $this->cust_repo = $cust_repo;
        $this->user_repo = $user_repo;
        $this->amazon_path = $gi->directoryPath();
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
        return $this->cust_repo->paginate($d,6);
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
        return view('customer.cuquote')->with(['quotes'=>$d,'amazon_path'=>$this->amazon_path]);
    }

    public function showRequests(){
        $d = $this->getRequests();
        return view('customer.request')->with('requests',$d);
    }

    public function contactVendor(Request $request){

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

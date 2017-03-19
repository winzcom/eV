<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Mail\SendQuote;
use App\Entities\User;
use App\Service\Service;
use App\Interfaces\GalleryInterface;
use App\Entities\Gallery;
use App\Entities\Review;
use App\Entities\Category;
use App\Entities\OffDays;
use App\Events\NewQuoteSentEvent;

class UserController extends Controller
{
    //

    

    private $gallery_implementation;
    private $period;

    public function __construct(GalleryInterface $gallery_implementation){

        $this->gallery_implementation = $gallery_implementation;
         $this->path = asset('storage/images/');
        

    }

    public function home(){

        
        $user =  User::with([
                 'galleries',
                 'categories',
                 'offdays'
        ]) ->find(Auth::id());


        return view('vendor.home')->with([
                'user'=>$user,'path'=>$this->path,
                'reviews'=>$this->getFiveReviews(),
                'quotes'=>$this->getQuotes(),
                'cats'=>Category::all()
            ]);
    }

    private function computeDays(){
                $begin = new Carbon(); 
                $begin->addDays(1);
                $end = $begin->copy()->addMonths(3);
                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);
            
                return $period;
    }

    public function updateProfile(RegisterFormRequest $request){
        
       
        $filtered = $request->except(['password_confirm','category','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $name_slug =  ['name_slug'=>str_slug($filtered['name'])];
        $filtered['vicinity_id'] = (int)$request->vicinity_id !== 0 ? (int)$request->vicinity_id:0 ;
        $filtered = array_merge($filtered,$name_slug);

      try{

         
          $user = User::where('id',Auth::id())->first();
          $user->update($filtered);
          $user->categories()->sync($request->category);
          return redirect('home')->with('message','Profile Updated');
                
      } 

      catch(Exception $e){
          dd('Error Encountered');
      }
    }

    public function showProfileForm(Request $request){
        
        $user  = Auth::user();
        return view('vendor.profile')->with([
            
                            'user'=>$user,
                            'formInputs'=>User::getFormInputs(),
                        ]);
    }



    public function showGallery(){
    
        $galleries = Gallery::where('user_id',Auth::id())->orderBy('id','desc')->get();
         return view('vendor.user_gallery')->with(['galleries'=>$galleries,'path'=>$this->path]);
    }

    public function publish(Request $request){

        $query = Gallery::where('id',$request->image_id);
        if($request->published == "true")
            $query->update(['publish'=>1]);
        else 
            $query->update(['publish'=>0]);
    }

    public function uploadPhotos(Request $request){
      
        $this->validate($request,[
            'photo.*'=>'mimes:jpeg,bmp,png,jfif,gif',
            'size'=>'5000'
        ],['size'=>'size must be less than 5MB']);

        

        $names = Service::uploadPhotos($this->gallery_implementation,$request->photo,$request->caption,Auth::user()->name_slug);
        if($request->ajax()){

                return json_encode(array('status'=>'Success','paths'=>$names));
        }
        
        return back();
    }

    public function deletePhotos(Request $request){

        if(count($request->images) > 0)
            Service::deletePhotos($this->gallery_implementation,$request->images);
        
        return back();
    }

    public function getFiveReviews(){
        $reviews = Review::where('review_for',Auth::id())->orderBy('id','desc')->take(5)->get();
        return $reviews;
    }

    public function getReviews(Request $request,$filter = null){

        $query = Review::where('review_for',Auth::id());
        $query1 = Review::where('review_for',Auth::id());
        $reviews = null;
        $pagination = 3;
        $total_avg = $query1->select(DB::raw('count(rating) as total,avg(rating) as avg'))->get();

       /* if($filter){
            if($filter == 'gt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','>=',$total_avg[0]->av]
                ])->paginate($pagination);
            }
            elseif($filter == 'lt'){
                $reviews = $query->where([
                                            ['review_for','=',Auth::id()],
                                            ['rating','<',$total_avg[0]->av]
                ])->paginate($pagination);
            }
        }

        else{
            $reviews = $query->paginate($pagination);
        }*/

        $reviews = $query->paginate($pagination);
        
        return view('vendor.reviews')->with(
            [
                'reviews'=>$reviews,
                'pagination'=>$pagination,
                'page'=>$request->query('page'),
                'total'=>$total_avg[0]->total,
                'avg'=>$total_avg[0]->avg
            ]);
    }

    public function addOffDays(Request $request){
        $from_date = date("Y-m-d",strtotime($request->from_date));

        if($request->to_date == null || $request->to_date == '' || empty($request->to_date)){
            $to_date = $from_date;
        }
        else 
            $to_date = date("Y-m-d",strtotime($request->to_date));
        
        if($request->ajax()){
           $offdays =  OffDays::create(['from_date'=>$from_date,
                            'to_date'=>$to_date,
                            'user_id'=>Auth::id()
                        ]);
                return json_encode(array('from_date'=>$offdays->from_date->format('l jS \\of F Y'),
                                         'to_date'=>$offdays->to_date->format('l jS \\of F Y'),
                                         'date_id'=>$offdays->id
                ));
        }
    }//end of addOffDays

    public function removeOffDays(Request $request){

        if($request->ajax()){
             OffDays::where(['id'=>$request->date_id,
                        'user_id'=>Auth::id()
            ])->delete();
            return json_encode(array('status'=>'Date Deleted'));
        }
       
    }

    public function reply(Request $request){

        $id = $request->review_id;
        $reply = $request->reply;
        if($request->ajax()){
            if($id !== '' && $reply !== ''){
                 Review::where('id','=',$id)->update(['reply'=>$reply]);
                 /*** Send email to reviewer */
                return json_encode(array('status'=>'Reply Posted'));
            }
        }
    }

    private function getQuotes(){
 
       $d = DB::table('quotes')->join('quotes_request','quotes.rid','=','quotes_request.id')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('companies','companies.id','=','quotes.uid')
                ->join('users','users.id','=','quotes.client_id')
                ->select('quotes.*','quotes_request.request as qrequest','categories.name as cat_name','users.first_name as fname'
                    ,'users.last_name as lname'
                )
                ->where('quotes.uid',Auth::id())->get();
        return $d;
    }


    public  function getRequests(){

        $d = DB::select(DB::raw(
            "select quotes_request.*,users.first_name as client_name,quotes.rid as rid,quotes.cost as cost,
            quotes.message as message, quotes.down_payment as dp,
            company_category.company_id, company_category.category_id
            from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id and companies.state = quotes_request.state 
            and (companies.vicinity_id = quotes_request.vicinity_id or quotes_request.vicinity_id = 0 )
            inner join users on users.id = quotes_request.client_id  
            left join quotes on quotes.rid=quotes_request.id and quotes.uid = companies.id 
            left join dismiss on dismiss.rid = quotes_request.id and dismiss.uid = companies.id
            where dismiss.rid is null and companies.id =:vendor_id order by quotes_request.id desc"
        ),array('vendor_id'=>Auth::id()));



        return (collect($d));
       
    }

    public function showRequests(){

        $req = $this->getRequests();
        $paginator = self::paginate($req,3);
        return view('vendor.requests')->with(['reqs'=>$paginator,
            
            'cats'=>Category::all()
        ]);
    }

    private static function paginate($data,$per_page){

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $sliced_data = $data->slice(($current_page-1)*$per_page,$per_page);
        $paginator = new LengthAwarePaginator($sliced_data,count($data),$per_page,$current_page);
        return $paginator;
       
    }

    public function getRequest($id){
        $d = DB::table('quotes_request')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('users','users.id','=','quotes_request.client_id')
                ->where('quotes_request.id',$id)
                ->select('quotes_request.*','categories.name','users.*')
                ->first();
            
        return $d;
    }

    public function getRequestNotYetAnswered(){

        return  $this->getRequests()->filter(function($value,$key){
             return $value->rid == null;
         });
    }

    public function getAnsweredRequests(){
        $d = DB::select(DB::raw(
                "select quotes_request.*,users.first_name as client_name,company_category.company_id, company_category.category_id from quotes_request 
                inner join company_category on company_category.category_id = quotes_request.category_id 
                inner join companies on companies.id = company_category.company_id and companies.state = quotes_request.state 
                and (companies.vicinity_id = quotes_request.vicinity_id or quotes_request.vicinity_id = 0 )
                inner join users on users.id = quotes_request.client_id 
                inner join quotes on quotes.rid = quotes_request.id and companies.id = quotes.uid 
                left join dismiss on dismiss.rid = quotes_request.id
                where companies.id =:user_id and dismiss.rid is null
                order by quotes_request.id desc"
            ),array('user_id'=>Auth::id()));
        
         return collect($d);
    }

    public function replyRequest(Request $request){
        
        $id = null; $client = null;
       
        

        DB::transaction(function() use ($request,$id){
            $id = DB::table('quotes')->insertGetId([
                'rid'=>$request->rid,
                'uid'=>$request->uid,
                'client_id'=>$request->client_id,
                'cost'=>$request->cost,
                'down_payment'=>$request->down_payment !== null ? $request->down_payment:0,
                'message'=>$request->message
            ]);

             $data = $this->getRequest($request->rid);

            $data = [

                    'request_data'=>$data,
                    'vendor_data'=>Auth::user(),
                    'cost'=>$request->cost,
                    'message'=>$request->message
            ];

           
            event(new NewQuoteSent($data));
            

        });
        

        if(!is_null($id)){

            $info = json_encode([
                'status'=>'Quotes Sent Successfully to '.$client->name
            ]);
            return $info;
        }
        else{
            return json_encode([
                'status'=>'Error Sending Please try again'
            ]);
        }
    }

    public function dismissRequest($rid,$uid,$client_id){

        if(!is_null($rid)){
            $id = DB::table('dismiss')->insertGetId([
                'rid'=>$rid,
                'uid'=>$uid,

            ]);

            if(!is_null($id)){
                return json_encode([
                'rid'=>$rid,
                'uid'=>$uid,
                'client_id'=>$client_id
            ]);
        }
        else{

            return json_encode([
                'status'=>'Error Performing Operation'
            ]);
        }

            
        }

         return json_encode([
                'rid'=>$rid,
                'uid'=>$uid,
                'client_id'=>$client_id
         ]);
    }
}

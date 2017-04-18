<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use App\Repo\Interfaces\UserRepoInterface as UPI;

use App\Entities\User;
use App\Service\Service;
use App\Interfaces\GalleryInterface;

use App\Entities\Category;
use App\Entities\OffDays;
use App\Events\NewQuoteSent;


class UserController extends Controller
{

    private $gallery;
   
    public function __construct(GalleryInterface $gi,UPI $user_repo){

        $this->gallery = $gi;
        $this->user_repo = $user_repo;
        $this->path = $this->gallery->directoryPath();
        
    }

    public function home(){
 
        $user = $this->user_repo->findWith(Auth::id(),['galleries','categories']);
        list($total_avg,$reviews) = $this->getFiveReviews();
        return view('vendor.home')->with([
                'user'=>$user,'path'=>$this->path,
                'reviews'=>$reviews,
                'avg'=>$total_avg[0]->avg,
                'cats'=>Service::getCategories()
            ]);
    }


    public function updateProfile(RegisterFormRequest $request){
        
        $file = $request->file('company_image');
        $filtered = $request->except(['password_confirm','category','_token','company_image']);
        $filtered['password'] = bcrypt($filtered['password']);
        if($file !== null && $file->isValid()){
            $filtered['company_image'] = Auth::user()->name.$file->getClientOriginalName();
            $file->storeAs('images',$filtered['company_image'],'public');
        }
        
        
        $filtered['name_slug'] = str_slug($filtered['name']);
        $filtered['vicinity_id'] = (int)$request->vicinity_id !== 0 ? (int)$request->vicinity_id:0 ;

      try{

         
          $user = $this->user_repo->findFirstByWhere(['id','=',Auth::id()]);
          $user->update($filtered);
          
          $user->categories()->sync($request->category);

          return redirect('home')->with('message','Profile Updated');    
      } 

      catch(Exception $e){
          dd('Error Encountered ');
      }
    }

    public function showProfileForm(Request $request){
        
        return view('vendor.profile')->with([
            
                            'user'=>Auth::user(),
                            'formInputs'=>User::getFormInputs(),
                        ]);
    }



    public function showGallery(){
        $galleries = $this->user_repo->getImages(['user_id','=',Auth::id()]);
        return view('vendor.user_gallery')->with(['galleries'=>$galleries,'path'=>$this->path]);
    }



    public function uploadPhotos(Request $request){
      
        
        $this->validate($request,[
            'photo.*'=>'mimes:jpeg,bmp,png,jfif,gif',
            'size'=>'5000'
        ],['size'=>'size must be less than 5MB']);

        

        $names = Service::uploadPhotos($this->gallery,$request->photo,$request->caption,Auth::user()->name_slug,Auth::id());
        if($request->ajax()){

                return json_encode(array('status'=>'Success','paths'=>$names));
        }
        
        return back();
    }

    public function deletePhotos(Request $request){

        if(count($request->images) > 0)
            Service::deletePhotos($this->gallery,$request->images,Auth::id());
        
        return back();
    }

    public function getFiveReviews(){
        return $this->user_repo->getReviews(Auth::id(),null,5,['id','desc']);
    }

    public function getReviews(Request $request,$filter = null){
        
        $pagination = 3;
        list($total_avg,$reviews,$query) = $this->user_repo->getReviews(Auth::id(),$pagination,null,['id','desc']);
        
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

        $offdays =  OffDays::create(['from_date'=>$from_date,
                            'to_date'=>$to_date,
                            'user_id'=>Auth::id()
                        ]);
        
        if($request->ajax()){
                return json_encode(array('from_date'=>$offdays->from_date->format('l jS \\of F Y'),
                                         'to_date'=>$offdays->to_date->format('l jS \\of F Y'),
                                         'date_id'=>$offdays->id
                ));
        }
        return back();
    }//end of addOffDays

    public function removeOffDays(Request $request){

        OffDays::where(['id'=>$request->date_id,
                        'user_id'=>Auth::id()
            ])->delete();

        if($request->ajax()){
             
            return json_encode(array('status'=>'Date Deleted'));
        }
        return back();
       
    }

    public function reply(Request $request){

        $id = $request->review_id;
        $reply = $request->reply;
        if($id !== '' && $reply !== ''){
                 $this->user_repo->createModel('reviews')->where('id','=',$id)->update(['reply'=>$reply]);

        if($request->ajax()){
                 /*** Send email to reviewer */
                return json_encode(array('status'=>'Reply Posted'));
            }
            return back();
        }
    }

    private function getQuotes(){
 
       return $this->user_repo->getQuotes();
    }


    public  function getRequests(){
        return $this->user_repo->getRequests();
    }

    public function showRequests(){

        $req = $this->getRequests();
        $paginator = $this->user_repo->paginate($req,3);
        return view('vendor.requests')->with(['reqs'=>$paginator,
            
            'cats'=>Service::getCategories()
        ]);
    }

    public function getRequest($id){
        return $this->user_repo->getRequest($id);
    }

    public function getRequestNotYetAnswered(){
        return $this->user_repo->getRequestNotYetAnswered();
    }

    public function getAnsweredRequests(){
        $this->user_repo->getAnsweredRequests();
    }

    public function replyRequest(Request $request){
        
        $id = null; $client = null;
       

        DB::transaction(function() use ($request,$id){
            $request_data = $this->user_repo->getRequest($request->rid);
            
            $id = DB::table('quotes')->insertGetId([
                'rid'=>$request->rid,
                'uid'=>Auth::id(),
                'client_id'=>$request->client_id,
                'cost'=>$request->cost,
                'down_payment'=>$request->down_payment !== null ? $request->down_payment:0,
                'message'=>$request->message
            ]);

          

            /*$datas = [

                    'request_data'=>$data,
                    'vendor_data'=>Auth::user(),
                    'cost'=>$request->cost,
                    'message'=>$request->message
            ];*/



            if(!is_null($id)){
                   event(new NewQuoteSent($request_data,Auth::user(),$request->cost,$request->message));
                   return response()->json([
                        'status'=>'Quotes Sent Successfully to '.$request_data->first_name.' '.$request_data->last_name
                        ]);
                    }
                else{
                    return response()->json([
                        'status'=>'Error Sending Please try again'
                    ],401);
                }

        });
        
    }

    public function dismissRequest($rid,$client_id){

        if(!is_null($rid)){
            $id = DB::table('dismiss')->insertGetId([
                'rid'=>$rid,
                'uid'=>Auth::id(),

            ]);

                if(!is_null($id)){
                    return response()->json([
                    'rid'=>$rid,
                    'uid'=>Auth::id(),
                    'client_id'=>$client_id
                ]);
            }
            else{

                return json_encode([
                    'status'=>'Error Performing Operation'
                ]);
            }

            
        }

         return response()->json([
             'Bad request'
         ],401);
    }
}

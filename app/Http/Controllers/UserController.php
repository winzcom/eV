<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use App\Repo\Interfaces\UserRepoInterface as UPI;

use Carbon\Carbon;

use App\Entities\User;
use App\Entities\Review;
use App\Service\Service;
use App\Interfaces\GalleryInterface;
use Illuminate\Filesystem\FilesystemManager;
use Aws\S3\S3Client;

use App\Entities\Category;
use App\Entities\QuotesRequest;
use App\Entities\Quote;
use App\Events\NewQuoteSent;


class UserController extends Controller
{

    private $gallery;
   
    public function __construct(GalleryInterface $gi,UPI $user_repo, FilesystemManager $laraelStorage,S3Client $s3Client){

        parent::__constructor($laraelStorage,$s3Client);

        $this->gallery = $gi;
        $this->user_repo = $user_repo;
        $this->path = $this->gallery->directoryPath();
        
    }

    public function home(){
        list($total_avg,$reviews) = $this->getFiveReviews();
        return view('vendor.home')->with([
                'user'=>request()->user(),'path'=>$this->path,
                'reviews'=>$reviews,
                'categories_count' => request()->user()->categoryRequestCount(),
                'avg'=>$total_avg[0]->avg,
                'cats'=>Service::getCategories()
            ]);
    }
    
    public function updateProfile(RegisterFormRequest $request){
        
        $file = $request->file('company_image');
        $filtered = $request->except(['password_confirm','category','_token','company_image']);
        $filtered['password'] = bcrypt($filtered['password']);
        if( $file !== null && $file->isValid() ){
            $filtered['company_image'] = Auth::user()->name.$file->getClientOriginalName();
            $filtered['company_image'] = $this->uploadFiles('s3',[$file],'public/company_image', $filtered['company_image'])[0];
            //$file->storeAs('company_images',$filtered['company_image'],'my_public');
        }
        $filtered['name_slug'] = str_slug($filtered['name']);
        $filtered['vicinity_id'] = (int)$request->vicinity_id !== 0 ? (int)$request->vicinity_id:0 ;

      try{
          //$user = $this->user_repo->findFirstByWhere(['id','=',Auth::id()]);
         $user = request()->user();
         $user->update($filtered);
          
          $user->categories()->sync($request->category);
          return redirect('home')->with('message','Profile Updated');    
      } 
      catch(Exception $e){
          return back()->withError('message','An Error Occured');
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
        return view('vendor.user_gallery')->with(['galleries'=>$galleries,'path'=>asset('galleries')]);
    }



    public function uploadPhotos(Request $request){
      
        $this->validate($request,[
            'photo.*'=>'mimes:jpeg,bmp,png,jfif,gif',
            'size'=>'5000'
        ],['size'=>'size must be less than 5MB']);
        try {
            $filePaths = collect($this->uploadFiles('s3',$request->photo,'public/galleries'))
            ->map(function($path) {
                return ['image_name' => $path];
            })->toArray();
            $instances = $request->user()->galleries()->createMany($filePaths);
            //$names = Service::uploadPhotos($this->gallery,$request->photo,$request->caption,Auth::user()->name_slug,Auth::id());
            if($request->ajax()){
                return $this->success([
                    'status'=>'Success','paths'=>$filePaths,
                    'galleries'=>$instances,'message'=>'Pictures Uploaded Successfully'
                ]);
            }
            return back();
        } catch(\Exception $e) {
            if($request->ajax()){
                return $this->error(array('status'=>'failed','message'=>'something happened'));
            }
            return back()->withErrors([
                'status'=>'failed',
                'message'=>'something happened'
            ]);
        }
        return back();
    }

    public function deletePhotos(Request $request){

        if(count($request->images) > 0)
            
            $bucket_name = env('AWS_BUCKET');
            //Service::deletePhotos($this->gallery,$request->images,Auth::id());
           try {
             $galleries = $request->user()->galleries()->whereIn('galleries.id',$request->images)->get();
             $galleries->each(function($gallery) {
                 $gallery->delete();
             });
             $filePaths = $galleries->pluck('image_name')->all();
             $this->deleteFiles($filePaths,$bucket_name);
           } catch(\Exception $e) {
               if($request->ajax()) 
                return $this->error([
                    'status' =>'something something happened'
                ]);
               return back()->withError('message',$e->getMessage());
           }
        if($request->ajax())
           return $this->success([
               'message' => 'Image(s) deleted successfully',
               'ids' => $request->images
           ]);
        return back()->with('message','Image deleted successfully');
    }

    public function getFiveReviews(){
        return $this->user_repo->getReviews(Auth::id(),null,5,['id','desc']);
    }

    public function getReviews(Request $request,$filter = null){
        
        $pagination = 10;
        list($total_avg,$reviews,$query) = $this->user_repo->getReviews(Auth::id(),$pagination,null,['id','desc']);
        
        return view('vendor.reviews')->with(
            [
                'reviews'=>$reviews,
                'pagination'=>$pagination,
                'page'=>$request->query('page'),
                'total'=>$total_avg[0]->total,
                'avg'=>$reviews->median('rating')
            ]);
    }

    public function addOffDay(Request $request){
        $from_date = date("Y-m-d",strtotime($request->from_date));

        if(!$request->has('to_date')){
            $to_date = $from_date;
        }
        else 
            $to_date = date("Y-m-d",strtotime($request->to_date));

            $offday =  OffDays::updateOrCreate(
                            [
                                'from_date'=>$from_date,
                                'to_date'=>$to_date,
                                'user_id'=>$request->user()->id
                            ]
                        );
        
        if($request->ajax()){
                return $this->success(array('from_date'=>$offdays->from_date->format('l jS \\of F Y'),
                        'to_date'=>$offdays->to_date->format('l jS \\of F Y'),
                        'date_id'=>$offdays->id
                    )
                );
        }
        return back();
    }

    public function removeOffDays(Request $request){

        OffDays::where(['id'=>$request->date_id,
                        'user_id'=>Auth::id()
            ])->delete();

        if($request->ajax()){ 
            return $this->success(array('status'=>'Date Deleted'));
        }
        return back();
       
    }

    public function updateAvailability($availability) {
        request()->user()->forceFill([
            'available' => (int) $availability,
            'availability_set_date' => date('Y-m-d H-i-s')
        ])->save();
        $this->success([
                'status'=>'Availability set'
            ]);
    }

    public function reply(Request $request){

        $id = $request->review_id;
        $reply = $request->reply;
        if($id !== '' && $reply !== ''){
            Review::where('id','=',$id)->update(['reply'=>$reply]);
        if($request->ajax()){
            return $this->success(['status'=>'Reply Posted']);
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
        $paginator = $this->user_repo->paginate($req,5);
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
       $content =  [
            'rid'=>$request->rid,
            'uid'=>Auth::id(),
            'client_id'=>$request->client_id,
            'cost'=>$request->cost,
            'down_payment'=>$request->down_payment !== null ? $request->down_payment:0,
            'message'=>$request->message
        ];

        if( $request->hasFile('quote_file') && $request->file('quote_file')->isValid() ) {
            $file = $request->file('quote_file');
            $content = array_merge($content, ['file_name' => $file->getClientOriginalName()]);
            $file->storeAs('file_quote',$file->getClientOriginalName(),'my_public');
        }
        $quote = null;
        if($request->has('editing')) {
            $quote = Quote::where('rid',$request->rid)->where('uid',$request->user()->id)->with('requests.client')->first();
            $quote->fill($content)->save();
            //check event date is greater than a week from now
            $date = @json_decode($quote->requests->request)->date;
            if(strtotime($date) > strtotime('+1 week'))
                try{
                    $quote->requests->client->notify(new \App\Notifications\QuoteEdited($quote));
                    return $this->success([
                        'status' => 200,
                        'message'=>'Quote Edited and customer '.$quote->requests->client->full_name.' will be notified',
                        'client' => $quote->requests->client
                    ]);
                } catch(\Exception $e) {
                    return $this->error([
                        'status' => $e->getCode(),
                        'message'=>'Mail could not be sent at this time to '.$quote->requests->client->full_name,
                        'client' => $quote->requests->client
                    ],422);
                }
        } else {
            $quote = Quote::create($content);
            if($quote !== null ) {
                $request_data = $this->user_repo->getRequest($request->rid);
                try{
                    event(new NewQuoteSent($request_data,Auth::user(),$quote));
                    return $this->success([
                        'status'=>'Quotes Sent Successfully to '.$request_data->first_name.' '.$request_data->last_name,
                        'client_id' => $quote->client_id,
                        'vendor_id' =>Auth::id(),
                        'rid' => $quote->rid,
                        'data' => $quote->newQuery()
                            ->select(DB::raw('avg(cost) as avg, max(cost) as max,min(cost) as min,count(uid) as count'))
                            ->where('rid',$quote->rid)
                            ->get()->push([
                                'cost'=>$quote->cost,
                                'message'=>$quote->message,
                                'dp'=>$quote->dp,
                            ])
                        ]);
                } catch(\Exception $e) {
                    return $this->error([
                        'status'=>'Your Quotes Could not be sent at this time ',
                        'message'=>$e->getMessage(),
                    ],422);
                }
            } else {
                $this->error(['status' =>'Reply could not be sent']);
            }
        }
       //$quote = Quote::create($content);
      
        // DB::transaction(function() use ($request,$id){
        //     $request_data = $this->user_repo->getRequest($request->rid);
            
            // $id = DB::table('quotes')->insertGetId([
            //     'rid'=>$request->rid,
            //     'uid'=>Auth::id(),
            //     'client_id'=>$request->client_id,
            //     'cost'=>$request->cost,
            //     'down_payment'=>$request->down_payment !== null ? $request->down_payment:0,
            //     'message'=>$request->message
            // ]);

            /*$datas = [

                    'request_data'=>$data,
                    'vendor_data'=>Auth::user(),
                    'cost'=>$request->cost,
                    'message'=>$request->message
            ];*/



        //     if(!is_null($id)){
        //            event(new NewQuoteSent($request_data,Auth::user(),$request->cost,$request->message));
        //            return response()->json([
        //                 'status'=>'Quotes Sent Successfully to '.$request_data->first_name.' '.$request_data->last_name
        //                 ]);
        //             }
        //         else{
        //             return response()->json([
        //                 'status'=>'Error Sending Please try again'
        //             ],402);
        //         }

        // });
        
    }

    public function dismissRequest($rid,$client_id){

        if(!is_null($rid)){
            try {
                $id = DB::table('dismiss')->insert([
                    'rid'=>$rid,
                    'uid'=>Auth::id(),
                ]);
                return $this->success([
                    'rid'=>$rid,
                    'uid'=>Auth::id(),
                    'client_id'=>$client_id
                ]);
            }catch(\Exception $e) {
                return $this->error([
                    'message'=>$e->getMessage()
                ],$e->getCode());
            }
        }

         return $this->error([
            'message' => 'Bad request'
        ],400);
    }

    public function getQuotesFromOthers() {
        try {
            $this->authorize('others_quotes',\App\Entities\User::class);
            if(!is_null(request()->rid)) {
                $data = QuotesRequest::with('quote.vendor')->where('id', request()->rid)->first();
                //$data = App\Entities\Quote::with('vendor')->where('rid',request()->rid)->get();
                return $this->success($data);
            } else {
                return $this->success([
                        'message'=>[
                            'message'=>'No Data Available',
                            'code'=>200
                        ]
                    ]);
            }    
            
        }catch(\Exception $e) {
            return $this->error(['error'=>[
                    'message'=>'You are not allowed to view others quotes',
                    'code'=>$e->getCode()
                ]
            ],$e->getCode());
        }
    }

    public function getUser() {
        $user = request()->user()->load(['self_client_chat_channel']);
        $data = [
            'user' => ['id' => $user->id,'name'=>$user->name,'email'=>$user->email],
            'client' => $user->self_client_chat_channel->map(function($item,$key){
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

    public function last6MonthsBudgetAverage(){

    }

    public function templateRendering() {

    }

    public function chatNotification() {
        try {
            $client = \App\Entities\User::findOrFail(request()->vendor_id);
            $client->notify(new \App\Notifications\ChatNotification());
        }catch(\Exception $e) {
            return $this->error([
                'status' => 'failed',
                'message' => $e->getMessage()
            ],500);
        }
    }
}

<?php
namespace App\Repo\Concrete;

use  App\Repo\Abstracts\BaseRepo;
use Illuminate\Database\Eloquent\Model;
use App\Repo\Interfaces\UserRepoInterface;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;
use App\Entities\Gallery;
use App\Entities\User;
use Illuminate\Foundation\Application;

use App\Entities\Review;

class MySqlUserRepo extends BaseRepo implements UserRepoInterface{

   
    public function __construct(Application $app){
        $this->app = $app;
        $this->model = $this->model();
    }
    

    protected function model(){
        return $this->app->make('\App\Entities\User');
    }

    public function createNewUser($data){
        $filtered =  array_except($data,['password_confirm','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $user =  $this->model()->create($filtered);

        return $user;
    }

    public function getReviews($id,$pagination = null,$take = null,$ordering = null){
       
       
        $query = $this->createModel('reviews')->where('review_for',$id);
        $query1 = clone $query;
        $total_avg = $query1->select(DB::raw('count(rating) as total,avg(rating) as avg'))->get();
        if(!is_null($ordering)){
            list($field,$order) = $ordering;
            if(!is_null($take))
                $reviews = $query->orderBy($field,$order)->take($take)->get();
            else
                $reviews = $query->orderBy($field,$order)->paginate($pagination);
        }
        else{
            if(!is_null($take))
                $reviews = $query->take($take)->get();
            else
                $reviews = $query->paginate($pagination);
        }
        
        return [$total_avg,$reviews,$query];
    }

    public function getImages(...$args){
           //$args = func_get_args();
           $array = $this->returnWhereArrays($args);        
         return $this->createModel('gallery')->where($array)->orderBy('id','desc')->get();
    }

    public function getQuotes(){
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
    public function getRequests(){
        $d = DB::select(DB::raw(
            "select quotes_request.*,users.first_name as client_name,quotes.rid as rid,quotes.cost as cost,
            quotes.message as message, quotes.down_payment as dp,b.ma as max_cost,b.mi as min_cost,b.cost_avg as avg_cost,
            company_category.company_id, company_category.category_id
            from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id and companies.state = quotes_request.state 
            and (companies.vicinity_id = quotes_request.vicinity_id or quotes_request.vicinity_id = 0 )
            inner join users on users.id = quotes_request.client_id  
            left join quotes on quotes.rid=quotes_request.id and quotes.uid = companies.id
            left join (select rid,max(q1.cost) as ma,min(q1.cost) as mi,avg(cost) as cost_avg from quotes q1 group by q1.rid) b on b.rid = quotes.rid
            left join dismiss on dismiss.rid = quotes_request.id and dismiss.uid = companies.id
            where dismiss.rid is null and companies.id =:vendor_id group by quotes.id,quotes_request.category_id order by quotes_request.id desc"
        ),array('vendor_id'=>Auth::id()));

        return collect($d);
    }

    public function getRequest($id){
        $d = DB::table('quotes_request')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('company_category','company_category.category_id','=','quotes_request.category_id')
                ->join('companies','companies.id','company_category.company_id')
                ->join('users','users.id','=','quotes_request.client_id')
                ->leftJoin('quotes',function($join){
                    $join->on('quotes.rid','=','quotes_request.id')
                    ->on('quotes.uid','=','companies.id');
                })
                ->where('quotes_request.id',$id)
                ->select('quotes_request.*','categories.name','users.*','quotes.*','users.id as user_id')
                ->first();
            
        return $d;
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

    public function getRequestNotYetAnswered(){
        return  $this->getRequests()->filter(function($value,$key){
             return $value->rid == null;
         });
    }
    
}
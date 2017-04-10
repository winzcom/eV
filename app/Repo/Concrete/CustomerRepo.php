<?php
namespace App\Repo\Concrete;

use  App\Repo\Abstracts\BaseRepo;
use Illuminate\Database\Eloquent\Model;
use App\Repo\Interfaces\CustRepoInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Application;

use App\Entities\Review;

class MySqlCustRepo extends BaseRepo implements CustRepoInterface{

   
    public function __construct(Application $app){
        $this->app = $app;
        $this->model = $this->model();
    }

    public function model(){
        return $this->app->make('\App\Entities\Customer');
    }

    public function getRequests(int $cust_id){
        $d = DB::select(DB::raw(
            "select DISTINCT(quotes_request.id),count(distinct(quotes.id)) as replies,
            categories.name as cat_name,quotes.rid as rid,
            quotes_request.request from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id 
            and companies.state = quotes_request.state 
            inner join categories on categories.id = company_category.category_id
            left join quotes on quotes.rid = quotes_request.id
            inner join users on users.id =quotes_request.client_id 
            where quotes_request.client_id = :customer_id
            group by quotes_request.id"
        ),array('customer_id'=>$cust_id));

        return collect($d);
    }

    public function getAnsweredRequests(int $cust_id){
        $d = DB::select(DB::raw(
            "select DISTINCT(quotes_request.id),count(distinct(quotes.id)) as replies,categories.name as cat_name,quotes_request.request from quotes_request 
            inner join company_category on company_category.category_id = quotes_request.category_id 
            inner join companies on companies.id = company_category.company_id 
            and companies.state = quotes_request.state 
            inner join categories on categories.id = company_category.category_id
            left join quotes on quotes.rid = quotes_request.id
            inner join users on users.id =quotes_request.client_id 
            where quotes_request.client_id = :customer_id
            group by quotes_request.id having replies > 0"
        ),array('customer_id'=>$cust_id));

        return collect($d);
    }

    public function getClientQuotes(int $cust_id){
        $d = DB::table('quotes')->join('quotes_request','quotes.rid','=','quotes_request.id')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('companies','companies.id','=','quotes.uid')
                ->join('users','users.id','=','quotes.client_id')
                ->select('quotes.*','quotes_request.request as qrequest','categories.name as cat_name','users.first_name as fname'
                    ,'users.last_name as lname'
                )
                ->where('quotes.client_id',$cust_id)->get();
        return collect($d);
    }

    public function getRequestQuotes(int $cust_id,int $request_id){
        $d = DB::table('quotes')->join('quotes_request','quotes.rid','=','quotes_request.id')
                ->join('categories','categories.id','=','quotes_request.category_id')
                ->join('companies','companies.id','=','quotes.uid')
                ->join('users','users.id','=','quotes.client_id')
                ->leftJoin('reviews','reviews.review_for','=','companies.id')
                ->leftJoin('galleries','galleries.user_id','=','quotes.uid')
                ->select('quotes.*','quotes_request.request as qrequest','categories.name as cat_name',
                        'reviews.review','reviews.reply','reviewers_name','rating','image_name',
                         'companies.*',(DB::raw("(select avg(r.rating) from reviews r where r.review_for = companies.id) as avg")),
                         (DB::raw("(select count(r.rating) from reviews r where r.review_for = companies.id) as count")
                         ),
                        (DB::raw("(select bay_average from bayesian_average where bayesian_average.review_for = companies.id) as bay_avg"))
                )
                ->where(['quotes.client_id'=>$cust_id,'quotes.rid'=>$request_id])->orderBy('bay_avg','desc')->get();
                //dd(json_encode($d->groupBy('id')[13]->unique()->pluck('image_name')->all()));
                 return $this->paginate($d->groupBy('id'),10);
    }

    public function getReviews(int $id,int $pagination = null,$take = null,$ordering = null){
        $query = Review::where('reviewers_id',$id);
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

    
}
<?php
namespace App\Repo\Abstracts;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Entities\Review;

abstract class BaseRepo {

    protected $model;
    protected $app;

    protected $models = [
        'reviews'=>'\App\Entities\Review',
        'gallery'=>'\App\Entities\Gallery',
        'quote'=>'\App\Entities\Quote',
        'user'=>'\App\Entities\User',
        'category'=>'\App\Entities\Category',
        'vendor'=>'App\Entities\User',
        'offdays'=>'App\Entities\OffDay',
        'customer'=>'App\Entities\Customer',
        'quotes_request'=>'App\Entities\QuotesRequest'
    ];

    public function __construct(){}

    public function findAll(){
        return $this->model->all();
    }
    public function find($id){
        return $this->model->find($id);
    }

    public function setNoLogVendorsNotAvailable($increment = '') {
        if($increment == 'increment') {
            DB::table('no_vendor_log')->where('category_id',request()->category)
                        ->where('state',request()->state)
                        ->where('vicinity_id',request()->locality)
                        ->increment('count');
        } else {
            DB::table('no_vendor_log')->insert(
                    [
                        'category_id' => request()->category, 'state' => request()->state, 
                        'vicinity_id' => request()->locality, 'count' => 1
                    ]
                );
        }
    }

    public function getCountNoTimesVendorsNotAvailable() {
        return DB::table('no_vendor_log')->where('category_id',request()->category)
                        ->where('state',request()->state)
                        ->where('vicinity_id',request()->locality)
                        ->count();
    }

    public function findWith($id,$relations){
        
        return $this->model->with($relations)->find($id);
    }

    public function update(){
        $args = func_get_args();
        $array = $this->returnWhereArrays($args);
        $this->model->update();
    }

    public function findBy(){
        
           $args = func_get_args();
           $array = $this->returnWhereArrays($args); 
           return $this->model->where($array)->get();
    }

    public function findFirstByWhere(){
           $args = func_get_args();
           $array = $this->returnWhereArrays($args); 
           return $this->model->where($array)->first();
        
    }

    public function getModel(){
        return $this->model;
    }

    public function createModel($key){

        if(array_key_exists($key,$this->models)){
            return $this->app->make($this->models[$key]);
        }
    }

    public function paginate($data,$per_page){

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $sliced_data = $data->slice(($current_page-1)*$per_page,$per_page);
        $paginator = new LengthAwarePaginator($sliced_data,count($data),$per_page,$current_page);
        return $paginator;
       
    }

    public function getSomeRequestsAndAverage($city = null){

         $sql = "select `quotes_request`.`request` as `qrequest`, quotes_request.state,vicinities.name as vn,
                    `categories`.`name` as `cat_name`, max(quotes.cost) as ma,min(quotes.cost) as mi, 
                     count(quotes.cost) as cc,avg(quotes.cost) as cost_avg 
                    from `quotes_request` inner join `quotes` on `quotes`.`rid` = `quotes_request`.`id`
                    left join vicinities on vicinities.id = quotes_request.vicinity_id 
                    inner join `categories` on `categories`.`id` = `quotes_request`.`category_id`";
            if($city != '' || $city !== null){
                $sql.="where quotes_request.state=:state";
            } 
            $sql.=" group by quotes.rid,quotes_request.id,cat_name,qrequest having cc > 0 limit 5";
                    
         $d = DB::select(DB::raw($sql),array('state'=>$city));
            return collect($d);
    }

    public function getTopVendors($state){
        
        return $this->model()->with('reviews','galleries')
            ->leftJoin('bayesian_average','bayesian_average.review_for','=','companies.id')
            ->addSelect('bayesian_average.*','companies.*')
            ->where('companies.state',$state)
            ->take(5)->orderBy('bayesian_average.bay_average','desc')->get();
    }

    protected function returnWhereArrays(array $args){
        
        $array = [];
        if(count($args) > 0){
            foreach($args as $key=>$value){
                if(is_array($value)){
                    $array[] = $value;
                }
            }
        }
        return $array;
    }

    abstract protected function model();

}

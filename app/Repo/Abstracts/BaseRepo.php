<?php
namespace App\Repo\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Repo\interfaces\RepoInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Entities\Review;

abstract class BaseRepo implements RepoInterface {

    protected $model;
    protected $app;

    protected $models = [
        'reviews'=>'\App\Entities\Review',
        'gallery'=>'\App\Entities\Gallery',
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
    public function find(int $id){
        return $this->model->find($id);
    }

    public function findWith(int $id,array $relations){
        
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
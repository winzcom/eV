<?php
namespace App\Repo\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Repo\interfaces\RepoInterface;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;
use App\Entities\Gallery;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use App\Entities\Review;

abstract class BaseRepo implements RepoInterface {

    protected $model;
    protected $app;

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


    public function paginate($data,$per_page){

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $sliced_data = $data->slice(($current_page-1)*$per_page,$per_page);
        $paginator = new LengthAwarePaginator($sliced_data,count($data),$per_page,$current_page);
        return $paginator;
       
    }

    public function getImages(){
           $args = func_get_args();
           $array = $this->returnWhereArrays($args);        
         return Gallery::where($array)->orderBy('id','desc')->get();
    }

    private function returnWhereArrays(array $args){
        
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

    public function getReviews(int $id,int $pagination = null,$take = null,$ordering = null){
       
       
        $query = Review::where('review_for',$id);
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
                $reviews = $query->get();
            else
                $reviews = $query->paginate($pagination);
        }
        
        return [$total_avg,$reviews,$query];
    }

    abstract protected function model();

}
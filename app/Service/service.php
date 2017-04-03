<?php
namespace App\Service;


use App\Entities\Category;
use App\Entities\User;
use App\Entities\Vicinity;
use App\Entities\Gallery;
 use App\Interfaces\RequestInterface;
use App\Interfaces\GalleryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\TreeNode\CategoryTree;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage; 
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;


class Service{


    protected $files;
    public function __construct(){
        
    }
    
    private function computeDays(){
                $begin = new Carbon(); 
                $begin->addDays(1);
                $end = $begin->copy()->addMonths(3);
                $interval = \DateInterval::createFromDateString('1 day');
                $period = new \DatePeriod($begin, $interval, $end);
            
                return $period;
    }

    public static function getCategories(){

           //return new \App\TreeNode\CategoryTree(0,'',-1);
           return Category::all();
    }

    public static function getFiveCompanies(){
        return User::has('reviews')->take(5)->get();
    }

    public static function getStates(){

        /*$expiresAt = Carbon::now()->addMinutes(1);
        return $value = Cache::remember('states', $expiresAt,function (){
            return  DB::table('states')->select('state')->OrderBy('state')->get();
        });*/

         return  DB::table('states')->select('*')->OrderBy('state')->get();
    }

    public static function getImages($directory){
        $files = File::files($directory);
        return $files;
    }

    public static function getTop5Companies(){
        return User::with(['galleries','reviews'=>function($q){

            $q->select(DB::raw(`*,((select count("reviews_for") from reviews)/(select count(distinct reviews_for from reviews))
                as 'avg_num_votes'
                (select avg("ratings") from reviews) as 'avg_rating',count("reviews_for") as 'this_num_votes',
                avg("ratings") as 'this_num_ratings' from ratings groupby ratings,reviews_for
            `));
        }])->take(5)->get();    
    }

    public static function getEvents(){
        return DB::table('events')->select('name','id')->OrderBy('name')->get();
    }

    public static function createNewUser($data){
         $filtered =  array_except($data,['password_confirm','_token']);
        $filtered['password'] = bcrypt($filtered['password']);
        $user =  User::create($filtered);

        return $user;
    }
    
    public static function deletePhotos(GalleryInterface $gallery,array $files,int $user_id){

        return $gallery->deletePhotos($files,$user_id);
            
    }

    public static function uploadPhotos(GalleryInterface $gallery,array $files,array $captions = null,string $name_slug = null,int $user_id){

        return $gallery->uploadPhotos($files,$captions,$name_slug);
    }

    public static function formRules(RequestInterface $request){

        return $request->rules(); 
    }

    public static function getVicinities(){
        return Vicinity::OrderBy('name')->get();
    }

    public static function paginate($data,$per_page){

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $sliced_data = $data->slice(($current_page-1)*$per_page,$per_page);
        $paginator = new LengthAwarePaginator($sliced_data,count($data),$per_page,$current_page);
        return $paginator;
       
    }

    public static function isValid(Array $data){
        foreach($data as $key=>$value){
            if(is_null($data[$key]) || empty($data[$key])){
                return false;
            }
        }

        return true;
    }

    public static function getResponseObject(){
        return new \Illuminate\Http\Response();
    }

    public static function setResponseContent($content){
        
        self::getResponseObject()->setContent($content);
        return $response;
    }

    public  function currencyFormatter(){

        $formatter = new \NumberFormatter('en_GB',  \NumberFormatter::CURRENCY);
        $formatter->setSymbol(\NumberFormatter::CURRENCY_SYMBOL,'');

        return $formatter;
    }

    public function showPopOverReviews($review,$reviewers_name,$reply,$rating){

        $template = "<div class='well'>";

        foreach($review as $key=>$item){
            
            $template .= "<h4>".$reviewers_name[$key]."<div class='rate' data-rating=".$rating[$key]."></div></h4>";
            $template .= '<p>'.$item.'</p>';
            if(array_key_exists($key,$reply)){
                $template .= "<div class='well'><p>Supplier's Reply</p>".$reply[$key].'</div>';
            }
        }
        $template .= '</div>';
        echo $template;
    }

    public function showPopOverImages($galleries,$path){

        $title = "<div class='slick'>";

        foreach($galleries as $gallery){
            $title .= "<img ";
            $title .= "src='";
            $title .= $path."/".$gallery."'";
            $title .= "style='width:100%'";
            $title .= "/>";
        }
        $title .="</div>";
        echo $title;
    }

    function limitWords($string, $word_limit)
    {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit));
    }

}
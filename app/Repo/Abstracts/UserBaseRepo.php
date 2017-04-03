<?php
namespace App\Repo\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Repo\Interfaces\UserRepoInterface;

use App\Repo\Abstracts\BaseRepo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;
use App\Entities\Gallery;


abstract class UserBaseRepo extends BaseRepo implements UserRepoInterface{

    
    abstract function getQuotes();
    abstract function getRequests();
    abstract function getRequest(int $id);
    abstract function getAnsweredRequests();
    //abstract function getReviews(int $id,int $pagination=null,$take=null,$ordering =null);
    

}
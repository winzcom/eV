<?php
namespace App\Repo\Abstracts;

use Illuminate\Database\Eloquent\Model;
use App\Repo\Interfaces\CustRepoInterface;


use App\Repo\Abstracts\BaseRepo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RegisterFormRequest;
use Illuminate\Support\Collection;



abstract class CustBaseRepo extends BaseRepo implements CustRepoInterface{

    
    abstract function getClientQuotes(int $cust_id);
    abstract function getRequests(int $cust_id);
    abstract function getRequestQuotes(int $cust_id,int $request_id);
    abstract function getAnsweredRequests(int $cust_id);
}
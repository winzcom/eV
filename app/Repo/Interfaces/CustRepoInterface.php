<?php

namespace App\Repo\Interfaces;

interface CustRepoInterface{

    public function getClientQuotes(int $cust_id);
    public function getRequests(int $cust_id);
    public function getRequestQuotes(int $cust_id,int $request_id);
    public function getAnsweredRequests(int $cust_id);
}

?>
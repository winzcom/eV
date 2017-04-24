<?php

namespace App\Repo\Interfaces;

interface CustRepoInterface{

    public function getClientQuotes($cust_id);
    public function getRequests($cust_id);
    public function getRequestQuotes($cust_id,$request_id);
    public function getAnsweredRequests($cust_id);
}

?>
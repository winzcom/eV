<?php

namespace App\Repo\Interfaces;

interface UserRepoInterface{

    public function getQuotes();
    public function getRequests();
    public function getRequest($id);
    public function getAnsweredRequests();
}

?>
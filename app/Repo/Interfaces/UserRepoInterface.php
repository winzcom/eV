<?php

namespace App\Repo\Interfaces;

interface UserRepoInterface{

    public function getQuotes();
    public function getRequests();
    public function getRequest(int $id);
    public function getAnsweredRequests();
}

?>
<?php

namespace App\Repo\Interfaces;

interface RepoInterface{

    public function find($id);
    public function findWith($id,$relations);
    public function findBy();
    public function findFirstByWhere();
    public function paginate($data,$per_page);
}

?>
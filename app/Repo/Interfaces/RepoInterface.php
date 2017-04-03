<?php

namespace App\Repo\Interfaces;

interface RepoInterface{

    public function find(int $id);
    public function findWith(int $id,array $relations);
    public function findBy();
    public function findFirstByWhere();
    public function paginate($data,$per_page);
}

?>
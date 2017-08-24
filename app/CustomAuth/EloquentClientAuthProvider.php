<?php

namespace App\CustomAuth;

    use Illuminate\Auth\EloquentUserProvider;
    use Illuminate\Contracts\Hashing\Hasher as HasherContract;
    use Illuminate\Support\Str;
    use Illuminate\Hashing\BcryptHasher;

class EloquentClientAuthProvider extends  EloquentUserProvider
{
    //
    public function __construct(){

            $hasher = new BcryptHasher();
            parent::__construct($hasher,'\App\Entities\Customer');
    }
    public function retrieveByCredentials(array $credentials){
        $user = parent::retrieveByCredentials($credentials);
        return $user;
    }
}

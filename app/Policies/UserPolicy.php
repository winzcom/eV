<?php

namespace App\Policies;

use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function others_quotes(User $user) {
        //Check user account
        return true;
    }

    public function can_send_more_quotes_this_month(User $user) {
        return $user->can_send_more_quotes();
    }
}

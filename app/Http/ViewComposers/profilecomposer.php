<?php 

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Http\Controllers\UserController;

class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $uc;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(UserController $uc)
    {
        // Dependencies automatically resolved by service container...
        $this->uc = $uc;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'requests'=> $this->uc->getRequests()
        ]);
                    
                     /*'unreplied_request'=>$this->uc->getRequestNotYetAnswered(),
                     'replied_request'=>$this->uc->getAnsweredRequests()*/
    }
}

?>
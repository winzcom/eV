<?php 

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repo\Interfaces\UserRepoInterface as IUserRepo;


class ProfileComposer
{
    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $user_repo;
    protected $formatter;

    /**
     * Create a new profile composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(IUserRepo $user_repo)
    {
        // Dependencies automatically resolved by service container...
        $this->user_repo = $user_repo;
        
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
            'requests'=> $this->user_repo->getRequests()
        ]);
                    
                     /*'unreplied_request'=>$this->uc->getRequestNotYetAnswered(),
                     'replied_request'=>$this->uc->getAnsweredRequests()*/
    }

}

?>
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repo\Interfaces\UserRepoInterface as URI;
use App\Repo\Interfaces\CustRepoInterface as CRI;
use App\Repo\Concrete\MySqlUserRepo as MSUR;
use App\Repo\Concrete\MySqlCustRepo as MSCR;

class RepoProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(
            URI::class,function($app){
                return new MSUR($app);
            }
        );

        $this->app->bind(
            CRI::class,function($app){
                return new MSCR($app);
            }
        );
    }
}

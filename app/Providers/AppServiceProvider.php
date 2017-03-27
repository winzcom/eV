<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\UserController as UC;
use App\Service\LocalGallery;
use App\Service\Service;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::share(['categories'=>Service::getCategories(),'states'=>Service::getStates(),
            'vicinities'=>Service::getVicinities(),'events'=>Service::getEvents()
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        
    }
}

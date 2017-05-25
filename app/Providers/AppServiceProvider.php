<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\UserController as UC;
use App\Service\LocalGallery;
use App\Service\Service;

use Aws\Sns\SnsClient;

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
        View::share(['categories'=>\App\Service\Service::getCategories(),'states'=>\App\Service\Service::getStates(),
            'vicinities'=>\App\Service\Service::getVicinities(),'events'=>\App\Service\Service::getEvents()
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
        $this->app->bind(SnsClient::class,function($app){
            return new SnsClient(
                            ['region'=>env('AWS_REGION'),'version'=>'2010-03-31',
                            'credentials'=>[
                                'secret'=>env('AWS_SECRET'),
                                'key'=>env('AWS_KEY'),
                            ]
                ]
            );
        });
    }
}

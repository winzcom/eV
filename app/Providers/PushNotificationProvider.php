<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\PushNotificationInterface as PI;
use App\Service\FirebasePushNotification as FP;

class PushNotificationProvider extends ServiceProvider
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
            PI::class,function($app){
                return new FP();
            }
        );
    }
}

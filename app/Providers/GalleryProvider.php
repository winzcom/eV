<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Service\LocalGallery;
use App\Service\AmazonGallery;
use App\Interfaces\GalleryInterface as GI;

class GalleryProvider extends ServiceProvider
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
        $this->app->bind(
            GI::class,function($app){
                return new LocalGallery();
            }
        );
    }
}

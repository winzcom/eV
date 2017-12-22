<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Service\LocalGallery;
use App\Service\AmazonGallery;
use App\Interfaces\GalleryInterface as GI;
use Aws\S3\S3Client;

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


        $this->app->bind(
            S3Client::class, function($app) {
                return new S3Client([
                        'region'  => env('AWS_REGION'),
                        'version' => '2006-03-01',
                        'credentials' => [
                            'secret' => env('AWS_SECRET'),
                            'key' => env('AWS_KEY'),
                        ],
                        'http'    => [
                            'verify' => false
                        ]
                      ]   
                    );
            }
        );
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class DashBoardViewComposer extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //

        View::composer(
                        [
                            'user.home', 'user.profile',
                            'user.reviews'
                        
                        ],
                        'App\Http\ViewComposers\ProfileComposer'
                    );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\NewRequestSentEvent' => [
            'App\Listeners\NewRequestSentListener',
        ],
        'App\Events\NewQuoteSentEvent'=>[
            'App\Listeners\NewQuotesSentListener'
        ],
        'App\Events\ContactVendorEvent'=>[
            'App\Listeners\ContactVendorListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}

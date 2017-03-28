<?php

namespace App\Listeners;

use App\Events\NewRequestSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRequest;

class NewRequestSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
 
    /**
     * Handle the event.
     *
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(NewRequestSentEvent $event)
    {
        //
        Mail::to($event->data['users_data'])
                ->send(new SendRequest($event->data));
       
    }
}

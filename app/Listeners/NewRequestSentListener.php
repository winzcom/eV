<?php

namespace App\Listeners;

use App\Events\NewRequestSentEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendRequest;
use App\Notifications\MultipleRequest;
use Illuminate\Support\Facades\Notification;

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
        
        try{
            if($event->data['request_exists']) {
                if(is_array($event->data['category']) && count($event->data['category']) > 1) {
                    Notification::send($event->data['users_data'],
                        new MultipleRequest($event->data['category'],$event->data['customer'])
                    );
                } else {
                    Mail::to($event->data['users_data'])
                    ->send(new SendRequest($event->data));   
                }
            }
        } catch(\Exception $e) {
            throw $e;
        }
       
    }
}

<?php

namespace App\Listeners;

use App\Events\NewQuoteSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

use App\Mail\SendQuote;
use App\Interfaces\PushNotificationInterface as PI;

class NewQuotesSentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
     protected $push_message;
    public function __construct(PI $push_message)
    {
        //
        
       $this->push_message = $push_message;
    }

    /**
     * Handle the event.
     *
     * @param  NewQuoteSent  $event
     * @return void
     */
    public function handle(NewQuoteSent $event)
    {
        //
       $this->push_message->pushMessage('f6EM8mIWTV0:APA91bGXqZ8dw9xRrAXxcGxbiTPq-L2_x8TtLSapiPOQdmsT3C9H3FYBUKD50WB0hdtZqbmr0OwKdZzVVHW-nvYYAfHaHToK-QQ6ylp1Dy13wrfG9YzebjBYPnD623Mqqr9NLIlgnooq',$event->vendor,$event->request);
        Mail::to($event->request)
               ->send(new SendQuote($event->request,$event->vendor,$event->cost,$event->message));

        //Send A Push notification

        
       
    }
}

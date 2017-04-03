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
       $this->push_message->pushMessage('emMVXDU2niI:APA91bGl9qC5qpIkCaSx9xUVCJHJlYcrL6gz4YC2dFdwJCR51GwWszTBqF8D4EzBV1I-2HdHSbLzzqskkXvoFGo6rKDqqcVA5EHv4dW7ebAwsK4oLCoLGmjtsGlThExBNVwqAnQmAQeH',$event->vendor,$event->request);
        Mail::to($event->request)
               ->queue(new SendQuote($event->request,$event->vendor,$event->cost,$event->message));

        //Send A Push notification

        
       
    }
}

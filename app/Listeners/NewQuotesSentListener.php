<?php

namespace App\Listeners;

use App\Events\NewQuoteSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Repo\Interfaces\UserRepoInterface as UPI;

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
     protected $repo;
    public function __construct(PI $push_message,UPI $repo)
    {
        //
        $this->repo = $repo;
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
        
       $client_firebase_endpoint = $this->repo->createModel('customer')->find($event->request->user_id)->firebase_endpoint;
       if($client_firebase_endpoint !== null)
            $this->push_message->pushMessage($client_firebase_endpoint,$event->vendor,$event->request->name);
        else {
            try {
                $mailer = Mail::to($event->request->email);
                $mailer->send(new SendQuote($event->request,$event->vendor,$event->cost,$event->message, $event->attachment));
            } catch(\Exception $e) {
                throw $e; 
            } 
        }
    }
}

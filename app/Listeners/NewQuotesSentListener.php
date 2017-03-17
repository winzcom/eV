<?php

namespace App\Listeners;

use App\Events\NewQuoteSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendQuote;

class NewQuotesSentListener
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
     * @param  NewQuoteSent  $event
     * @return void
     */
    public function handle(NewQuoteSent $event)
    {
        //
        Mail::to($event->data['request_data'])
                ->send(new SendQuote($event->data));
    }
}

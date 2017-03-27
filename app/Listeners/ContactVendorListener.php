<?php

namespace App\Listeners;

use App\Events\ContactVendorEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactVendorListener
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
     * @param  ContactVendorEvent  $event
     * @return void
     */
    public function handle(ContactVendorEvent $event)
    {
        //
    }
}

<?php

namespace App\Listeners;

use App\Events\ContactVendorEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\ContactVendor;
use Illuminate\Support\Facades\Mail;

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
        //Send Mail to Vendor
        try{
            Mail::to($event->vendor)
                ->send(new ContactVendor($event->vendor,$event->customer,$event->request,$event->message));
        }
        catch(\Exception $e){
            return response()->json([
                'message'=>'An Error Occured Message could not be sent'
            ]);
        }
        
    }
}

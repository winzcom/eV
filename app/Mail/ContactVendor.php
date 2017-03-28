<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactVendor extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $vendor;
     protected $customer;
     protected $request;
     
    public function __construct($vendor,$customer,$request,$message)
    {
        //
        $this->vendor = $vendor;
        $this->customer = $customer;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->customer)->markdown('emails.contact_vendor.message')->with(
            [
                'vendor'=>$this->vendor,'customer'=>$this->customer,'request'=>$this->request,
                'message'=>$this->message
            ]
        );
    }
}

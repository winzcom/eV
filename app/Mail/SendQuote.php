<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQuote extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $data;


    public function __construct($request,$vendor,$cost,$message)
    {
        //
        $this->request = $request;
        $this->vendor = $vendor;
        $this->cost = $cost;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->vendor)->markdown('emails.quotes.send_quote')
                    ->with([
                        'request'=>$this->request,
                        'vendor'=>$this->vendor,
                        'cost'=>$this->cost,
                        'message'=>$this->message
                    ]);
    }
}

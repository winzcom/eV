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

     protected $request;
     protected $vendor;
     protected $cost;
     protected $message;
     protected $attachment;

    public function __construct($request,$vendor,$cost,$message,$attachment = null)
    {
        //
        $this->request = $request;
        $this->vendor = $vendor;
        $this->cost = $cost;
        $this->message = $message;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailer = $this->from('quote@eventpad.ng')->markdown('emails.quotes.send_quote');
        if( $this->attachment !== null ) {
            $mailer->attach(public_path().'/file_quote\/'.$this->attachment);
        }
           return $mailer->with([
                        'request'=>$this->request,
                        'vendor'=>$this->vendor,
                        'cost'=>$this->cost,
                        'message'=>$this->message
                    ]);
    }
}

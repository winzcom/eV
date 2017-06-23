<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     protected $data;

    public function __construct(Array $data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this 
     */
    public function build()
    {
        return $this->from('eventpad.ng')
                    ->subject('New Quote')
                    ->markdown('emails.requests.send_request')
                    ->with('data',$this->data);
    }
}

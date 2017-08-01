<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailTypeVerification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $url; public $name;

    public function __construct($name = null)
    {
        //
        $this->url = url("verify/vendor/email/");
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Invite@eventpad.ng')
        ->subject('Welcome to Eventpad')
        ->markdown('emails.verification.testmail');
    }
}

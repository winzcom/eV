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

     private $url;

    public function __construct()
    {
        //
        $this->url = url("verify/vendor/email/");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Invite@eventpad.ng')->subject('Joining Eventpad')->markdown('emails.verification.emailtypeverifcation')->with('url',$this->url);
    }
}

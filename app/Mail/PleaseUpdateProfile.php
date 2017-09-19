<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PleaseUpdateProfile extends Mailable
{
    use Queueable, SerializesModels;

    public $company_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company_name)
    {
        //
        $this->company_name = $company_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('view.name');
    }
}

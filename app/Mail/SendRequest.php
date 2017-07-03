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
        return $this->from('Request@eventpad.ng')
                    ->subject('New Request')
                    ->markdown('emails.requests.send_request')
                    ->with([
                        'data'=>$this->data,
                        'category'=>$this->data['users_data']->first()->categories()->where('categories.id',$this->data['category'])->first()->name,
                        'first_name'=>$this->data['customer']->first_name, 'last_name'=>$this->data['customer']->last_name,
                        'requests'=>$this->data['request']
                    ]);
    }
}

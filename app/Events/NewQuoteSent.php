<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewQuoteSent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

     protected $request_data;
     protected $vendor;
     protected $cost;
     protected $message;

    public function __construct($request,$vendor,$cost,$message)
    {
        //
       
        $this->request = $request;
        $this->vendor = $vendor;
        $this->cost = $cost;
        $this->message = $message;
    }

    public function __get($name){
        if(property_exists($this,$name)){
            return $this->$name;
        }
        else{
            dd('no property like that');
        }
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

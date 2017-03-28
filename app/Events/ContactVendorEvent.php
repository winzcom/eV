<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Entities\User;

class ContactVendorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

     protected $vendor;
     protected $customer;
     protected $request;
     protected $message;

    public function __construct($vendor,$customer,$request,$message)
    {
        //
        $this->vendor = $vendor;
        $this->customer = $customer;
        $this->request = $request;
        $this->message = $message;
    }

    public function __get($name){
        if(property_exists($this,$name)){
            return $this->$name;
        }
        else throw new \Exception;
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

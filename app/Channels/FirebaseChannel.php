<?php

namespace App\Channels;

use Illuminate\Notifications\Notification;

class FirebaseChannel {


    public function send($notifiable,$notification) {
        if($notifiable->firebase_endpoint) {
            return $notification->toFirebase($notifiable);
        }
    }
}

?>
<?php

    namespace App\Interfaces;

    Interface PushNotificationInterface{

        public function pushMessage($end_point,$vendor,$request);
    }

?>
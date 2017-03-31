<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Interfaces\PushNotificationInterface as PI;

class SendPushNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

     protected $push_notification;
     protected $end_point;

    public function __construct()
    {
        //
        $this->push_notification = resolve(PI::class);
       
        $this->endpoint = 'f6EM8mIWTV0:APA91bGXqZ8dw9xRrAXxcGxbiTPq-L2_x8TtLSapiPOQdmsT3C9H3FYBUKD50WB0hdtZqbmr0OwKdZzVVHW-nvYYAfHaHToK-QQ6ylp1Dy13wrfG9YzebjBYPnD623Mqqr9NLIlgnooq';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $this->push_notification->pushMessage($this->endpoint);
    }
}

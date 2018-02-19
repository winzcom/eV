<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use GuzzleHttp\Client;

class ChatNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail',\App\Channels\FirebaseChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = null; $name = null;
        if(request()->user()) {
            $url = '/culogin';
            $name = request()->user()->name;
        } else {
            $url = '/login';
            $name = request()->user('client')->full_name;
        }
        return (new MailMessage)
                    ->line('A new chat message from '.$name)
                    ->action('Please login to chat', url($url))
                    ->line('Thank you for using our application!');
    }


    public function toFirebase($notifiable) {
        try{
            $client = new Client();
            return $response = $client->request('POST','https://fcm.googleapis.com/fcm/send',[
            'headers'=>[
                'Authorization'=>
                'key= '.env('GCM_KEY'),
                'Content-Type'=>'application/json'

            ],
            'json'=>[
                'to'=>$notifiable->firebase_endpoint,
                'data'=>[
                    
                        'title'=> 'New chat message',
                        'body'=>'New chat message from'.$name,
                        'click_action'=>'https://eventpad.ng/'.$url
                    
                ],
                'notification'=>[
                    'title'=> 'New chat message',
                    'body'=>'New chat message from'.$name,
                    'click_action'=>'https://eventpad.ng/'.$url             ]
            ]
        ]); 
        }catch(\Exception $e){
            return 'Failed to Send';
        }   
    } 

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

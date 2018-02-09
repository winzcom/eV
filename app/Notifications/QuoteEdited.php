<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class QuoteEdited extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        //
        $this->data = $data;
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
        return (new MailMessage)
                    ->success()
                    ->greeting('Hello '.$notifiable->full_name)
                    ->subject('Quote Edited')
                    ->line('Quote from '.request()->user()->name.' for '.$this->data->requests->category->name)
                    ->line('on '.$this->data->requests->created_at->toFormattedDateString().' has been edited')
                    ->action('login to see changes',url('/culogin'))
                    ->line('Thank you for using our platform!');
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
            ''
        ];
    }

    public function toFirebase($notifiable) {
        try{
            $client = new Client();
            return $response = $client->request('POST','https://fcm.googleapis.com/fcm/send',[
            'headers'=>[
                'Authorization'=>
                'key='.env('GCM_KEY'),
                'Content-Type'=>'application/json'

            ],
            'json'=>[
                'to'=>$notifiable->firebase_endpoint,
                'data'=>[
                    
                        'title'=> 'Quote Edited',
                        'body'=>'The Quote from '.request()->user()->name.' For '.$this->data->requests->category->name.' has been Edited',
                        'click_action'=>'https://eventpad.ng/culogin'
                    
                ],
                'notification'=>[
                    'title'=> 'Quote Edited',
                    'body'=>'The Quote from '.request()->user()->name.' For '.$this->data->requests->category->name.' has been Edited',
                    'click_action'=>'https://eventpad.ng/culogin'             ]
            ]
        ]); 
        }catch(\Exception $e){
            return 'Failed to Send';
        }   
    } 
}

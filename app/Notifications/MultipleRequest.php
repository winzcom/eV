<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MultipleRequest extends Notification
{
    use Queueable;

    public $categories;
    public $customer;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($categories,$customer)
    {
        //
        $this->categories = $categories;
        $this->customer = $customer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->from('Request@eventpad.ng','EventPad')
                    ->subject('New Requests')
                    ->line('New requests from '.$this->customer->full_name)
                    ->line('for '.$notifiable->categories()->whereIn('categories.id',$this->categories)
                            ->get(['name'])->implode('name',',')
                        )
                    ->action('Please login to reply with your quotes', url('/login'))
                    ->line('Thank you for using our application!');
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

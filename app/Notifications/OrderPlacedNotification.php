<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $order;

    public function __construct(Order $order)
    {
        $this->order= $order;
        // print_r($this->order);
        // dd();
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        //dd($notifiable);
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($notifiable);
       //dd($this->order->user->email);
        return (new MailMessage())->from($this->order->user->email)
                                ->subject('Order Placed')
                                ->markdown('emails.orderplacednotification',[ 'order'=>$this->order]);
    }



    public function toDatabase()
    {
        return [
            'amount'=> round($this->order->billing_total,2),
        ];
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

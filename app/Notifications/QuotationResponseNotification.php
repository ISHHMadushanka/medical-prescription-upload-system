<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuotationResponseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */

     protected $response;
     protected $quotation;

    public function __construct($response, $quotation)
    {
        $this->response = $response;
        $this->quotation = $quotation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Quotation Response')
                    ->line('Your quotation has been ' . $this->response . ' by the user.')
                    ->action('View Quotation', url('/quotations/' . $this->quotation->id));
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

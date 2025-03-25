<?php

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;

// class SslExpiryNotification extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @return array<int, string>
//      */
//     public function via(object $notifiable): array
//     {
//         return ['mail'];
//     }

//     /**
//      * Get the mail representation of the notification.
//      */
//     public function toMail(object $notifiable): MailMessage
//     {
//         return (new MailMessage)
//                     ->line('The introduction to the notification.')
//                     ->action('Notification Action', url('/'))
//                     ->line('Thank you for using our application!');
//     }

//     /**
//      * Get the array representation of the notification.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(object $notifiable): array
//     {
//         return [
//             //
//         ];
//     }
// }


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\SslCertificate;

class SslExpiryNotification extends Notification
{
    use Queueable;

    public $sslCertificate;

    public function __construct(SslCertificate $sslCertificate)
    {
        $this->sslCertificate = $sslCertificate;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $expiryDate = $this->sslCertificate->expiry_date->format('Y-m-d');

        return (new MailMessage)
            ->subject("⚠️ SSL Expiry Alert: {$this->sslCertificate->website->name}")
            ->greeting("Hello,")
            ->line("The SSL certificate for **{$this->sslCertificate->website->name}** will expire on **$expiryDate**.")
            ->line("Please renew it as soon as possible to avoid downtime.")
            ->action('Check Website', url($this->sslCertificate->website->url))
            ->line("This is an automated alert from NexusMonitor.");
    }
}

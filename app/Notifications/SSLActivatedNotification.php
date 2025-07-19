<?php

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Notifications\Notification;
// use Illuminate\Notifications\Messages\MailMessage;

// class SSLActivatedNotification extends Notification
// {
//     use Queueable;

//     public function via($notifiable)
//     {
//         return ['mail'];
//     }

//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//             ->subject('🔒 SSL Activated Notification')
//             ->greeting('Hello Samith,')
//             // ->line('SSL has been successfully activated for the selected website.')
//             ->line('SSL has been expired .')

//             ->line('Action: ✅ **Active SSL** was clicked.')
//             ->line('Time: ' . now()->format('Y-m-d H:i:s'));

//     }
// }


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Website;

class SSLActivatedNotification extends Notification
{
    use Queueable;

    public $website;

    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('🔒 SSL Activated Notification')
            ->greeting('Hello Samith,')
            ->line("🔗 **Website:** {$this->website->name} ({$this->website->url})")
            ->line("⚠️ SSL has been expired in {$this->website->name} .")
            ->line("You can activate SSL for the {$this->website->name} ");
            // ->line('Time:** ' . now()->format('Y-m-d H:i:s'));
    }
}

<?php

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;
// use App\Models\Website;

// class WebsiteDownNotification extends Notification
// {
//     use Queueable;
//     public $website;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct()
//     {
//         $this->website = $website;
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
//                  ->subject("🚨 Website Down Alert: {$this->website->name}")
//             ->greeting("Hello,")
//             ->line("The website **{$this->website->name}** ({$this->website->url}) is currently **DOWN**.")
//             ->line("🕒 **Time of Failure:** " . now()->format('Y-m-d H:i:s'))
//             ->action('Check Website', url($this->website->url))
//             ->line("Please investigate and resolve the issue immediately.");
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
use App\Models\Website;
use App\Models\WebsiteLog;

class WebsiteDownNotification extends Notification
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
            ->subject("🚨 Website Down Alert: {$this->website->name}")
            ->greeting("Hello,")
            ->line("The website **{$this->website->name}** ({$this->website->url}) is currently **DOWN**.")
            ->line("🕒 **Time of Failure:** " . now()->format('Y-m-d H:i:s'))
            ->line(" **Reason of Failure:** ({$this->website->error_details})")
            ->action('Check Website', url($this->website->url))
            ->line("Please investigate and resolve the issue immediately.");
    }
}

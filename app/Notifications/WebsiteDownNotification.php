<?php


// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Notifications\Notification;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use App\Models\Website;
// use App\Models\WebsiteLog;

// class WebsiteDownNotification extends Notification
// {
//     use Queueable;

//     public $website;

//     public function __construct(Website $website)
//     {
//         $this->website = $website;
//     }

//     public function via($notifiable)
//     {
//         return ['mail']; 
//     }

//     public function toMail($notifiable)
//     {
//         return (new MailMessage)
//             ->subject("🚨 Website Down Alert: {$this->website->name}")
//             ->greeting("Hello,")
//             ->line("The website **{$this->website->name}** ({$this->website->url}) is currently **DOWN**.")
//             ->line("🕒 **Time of Failure:** " . now()->format('Y-m-d H:i:s'))
//             ->line(" **Reason of Failure:** ({$this->website->error_details})")
//             ->action('Check Website', url($this->website->url))
//             ->line("Please investigate and resolve the issue immediately.");
//     }
// }



namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Website;
use App\Models\WebsiteLog;

class WebsiteDownNotification extends Notification
{
    use Queueable;

    public $website;
    public $errorLog;

    public function __construct(Website $website)
    {
        $this->website = $website;

        // Get latest error log for the website
        $this->errorLog = WebsiteLog::where('website_id', $website->id)
            ->orderBy('created_at', 'desc')
            ->first();
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
            ->line(" **Time of Failure:** " . now()->format('Y-m-d H:i:s'))
            ->line(" **Reason of Failure:** " . ($this->errorLog->error_message ?? 'Unknown'))
            ->action('Check Website', url($this->website->url))
            ->line("Please investigate and resolve the issue immediately.");
    }
}

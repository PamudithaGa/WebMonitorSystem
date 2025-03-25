<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;
use App\Models\Website;
use App\Models\Users;

class WebsiteDownSmsNotification extends Notification
{
    use Queueable;
    public $website;

    /**
     * Create a new notification instance.
     */
    public function __construct(Website $website)
    {
        $this->website = $website;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['twilio'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toTwilio(object $notifiable)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $message = "🚨 ALERT! Website {$this->website->name} is DOWN!\nURL: {$this->website->url}\nTime: " . now()->format('Y-m-d H:i:s');

        $twilio->messages->create(
            $notifiable->phone, // Recipient’s phone number
            [
                'from' => env('TWILIO_PHONE'), // Twilio phone number
                'body' => $message,
            ]
        );
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

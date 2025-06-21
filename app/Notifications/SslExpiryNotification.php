<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notifiable;

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

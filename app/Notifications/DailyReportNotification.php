<?php

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;

// class DailyReportNotification extends Notification
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
use App\Models\WebsiteLog;
// use Illuminate\Notifications\Messages\MailContent;
use Carbon\Carbon;

class DailyReportNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $date = Carbon::yesterday()->format('Y-m-d'); // Get yesterday's date
        $logs = WebsiteLog::whereDate('logged_at', Carbon::yesterday())->get();

        if ($logs->isEmpty()) {
            $reportData = "✅ No website downtimes recorded for **$date** 🎉";
        } else {
            $reportData = "<table border='1' cellpadding='8' cellspacing='0' width='100%'>";
            $reportData .= "<tr><th>Website</th><th>Status</th><th>Time</th><th>Error</th></tr>";

            foreach ($logs as $log) {
                $reportData .= "<tr>";
                $reportData .= "<td>{$log->website->name}</td>";
                $reportData .= "<td style='color:red;'><strong>{$log->status}</strong></td>";
                $reportData .= "<td>{$log->logged_at}</td>";
                $reportData .= "<td>{$log->error_details}</td>";
                $reportData .= "</tr>";
            }

            $reportData .= "</table>";
        }

        return (new MailMessage)
            ->subject("📊 Daily Website Monitoring Report - $date")
            ->greeting("Hello Team,")
            ->line("Here is the **website downtime summary** for **$date**:")
            // ->line(new MailContent($reportData)) 
            ->line(new \Illuminate\Support\HtmlString($reportData))
            ->line("For a full history, please check the system dashboard.")
            ->salutation("Best Regards, \nNexusMonitor");
    }
}

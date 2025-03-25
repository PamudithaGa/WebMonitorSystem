<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\CheckWebsiteStatus;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use App\Notifications\DailyReportNotification;
use App\Models\SslCertificate;
use App\Notifications\SslExpiryNotification;
use Carbon\Carbon;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('inspire')->hourly();

Schedule::command('monitor:check-websites')->everyMinute();

Schedule::call(function () {
    // $emails = ['parindya@allinoneholdings.com', 'kanchana@allinoneholdings.com', 'sammith@allinoneholdings.com'];
    $emails = ['pamuditha@allinoneholdings.com', 'pamudithagangana45@gmail.com'];

    foreach ($emails as $email) {
        \Illuminate\Support\Facades\Notification::route('mail', $email)->notify(new DailyReportNotification());
    }
})->dailyAt('16:30'); 


Schedule::command('monitor:check-ssl')->daily();

Schedule::call(function () {
    $alerts = [60, 30, 14, 7, 1]; // Days before expiry
    // $emails = ['parindya@allinoneholdings.com', 'kanchana@allinoneholdings.com', 'sammith@allinoneholdings.com'];
    $emails = ['pamuditha@allinoneholdings.com', 'pamudithagangana45@gmail.com'];

    foreach (SslCertificate::where('alert_sent', false)->get() as $ssl) {
        $daysLeft = Carbon::now()->diffInDays($ssl->expiry_date, false);

        if (in_array($daysLeft, $alerts)) {
            foreach ($emails as $email) {
                \Illuminate\Support\Facades\Notification::route('mail', $email)->notify(new SslExpiryNotification($ssl));
            }

            $ssl->update(['alert_sent' => true]);
        }
    }
})->dailyAt('08:00'); 
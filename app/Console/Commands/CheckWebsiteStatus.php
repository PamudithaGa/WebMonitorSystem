<?php

namespace App\Console\Commands;


use App\Models\Website;
use App\Models\WebsiteLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Command;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;

use App\Notifications\WebsiteDownNotification;
use App\Notifications\WebsiteDownSmsNotification;



class CheckWebsiteStatus extends Command
{
    protected $signature = 'monitor:check-websites';
    protected $description = 'Check the status of all monitored websites and update the database';


    public function handle()
    {

        $websites = Website::all();
        foreach ($websites as $website) {
            try {
                $response = Http::timeout(10)->get($website->url);
                $status = $response->successful() ? 'Active' : 'Down';
                $errorDetails = null;
            } catch (\Exception $e) {

                $status = 'Down';
                //new added 
                $errorDetails = $e->getMessage();
            }

            if ($website->status !== $status) {
                $website->update([
                    'status' => $status,
                    'last_checked' => now(),
                ]);

                WebsiteLog::create([
                    'website_id' => $website->id,
                    'status' => $status,
                    'error_details' => $errorDetails,

                ]);

                if ($status === 'Down') {
                    // $emails = ['parindya@allinoneholdings.com', 'kanchana@allinoneholdings.com', 'sammith@allinoneholdings.com'];
                    $emails = ['pamuditha@allinoneholdings.com', 'pamudithagangana45@gmail.com'];

                    foreach ($emails as $email) {
                        \Illuminate\Support\Facades\Notification::route('mail', $email)->notify(new WebsiteDownNotification($website));
                    }
                }
            }
        }

        $this->info('Website statuses updated and email alerts sent for down websites.');
    }
}

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

    //     public function handle()
    //     {
    //         $websites = Website::all();
    //         foreach ($websites as $website) {
    //             try {
    //                 $response = Http::timeout(10)->get($website->url);
    //                 $status = $response->successful() ? 'Active' : 'Down';

    //                 $website->update([
    //                     'status' => $status,
    //                     'last_checked' => now(),
    //                 ]);

    //                 Log::info("Checked {$website->url} - Status: $status");
    //             } catch (\Exception $e) {
    //                 // If an error occurs (timeout, DNS issue), mark the website as down
    //                 $website->update([
    //                     'status' => 'Down',
    //                     'last_checked' => now(),
    //                 ]);

    //                 Log::error("Failed to check {$website->url} - Marked as Down.");
    //             }
    //         }

    //         $this->info('Website statuses updated successfully.');
    //     }
    // }




    public function handle()
    {

        // $client = new Client(['timeout' => 10]); // Timeout after 10 seconds
        // $websites = Website::all();

        // foreach ($websites as $website) {
        //     $status = 'Active';
        //     $errorDetails = null;

        //     try {
        //         $response = $client->get($website->url);
        //         if ($response->getStatusCode() !== 200) {
        //             $status = 'Down';
        //             $errorDetails = "HTTP Error: " . $response->getStatusCode();
        //         }
        //     } catch (ConnectException $e) {
        //         $status = 'Down';
        //         $errorDetails = "Connection Timeout (Site may be down)";
        //     } catch (RequestException $e) {
        //         $status = 'Down';
        //         $errorDetails = "Request Failed: " . $e->getMessage();
        //     } catch (ServerException $e) {
        //         $status = 'Down';
        //         $errorDetails = "Server Error (500 or similar)";
        //     } catch (\Exception $e) {
        //         $status = 'Down';
        //         $errorDetails = "Unknown Error: " . $e->getMessage();
        //     }

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

                // if ($status === 'Down') {
                //     $admins = User::where('role', 'admin')->get();
                //     foreach ($admins as $admin) {
                //         $admin->notify(new WebsiteDownSmsNotification($website));
                //     }
                // }
            }
        }

        $this->info('Website statuses updated and email alerts sent for down websites.');
    }
}

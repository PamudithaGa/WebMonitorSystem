<?php

// namespace App\Console\Commands;

// use Illuminate\Console\Command;

// class CheckSslExpiry extends Command
// {
//     /**
//      * The name and signature of the console command.
//      *
//      * @var string
//      */
//     protected $signature = 'app:check-ssl-expiry';

//     /**
//      * The console command description.
//      *
//      * @var string
//      */
//     protected $description = 'Command description';

//     /**
//      * Execute the console command.
//      */
//     public function handle()
//     {
//         //
//     }
// }


namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Website;
use App\Models\SslCertificate;
use Carbon\Carbon;

class CheckSslExpiry extends Command
{
    protected $signature = 'monitor:check-ssl';
    protected $description = 'Check SSL expiry dates and update database';

    public function handle()
    {
        $websites = Website::all();

        foreach ($websites as $website) {
            $url = parse_url($website->url, PHP_URL_HOST); // Extract domain
            $sslInfo = @stream_context_create(["ssl" => ["capture_peer_cert" => true]]);
            $socket = @stream_socket_client("ssl://$url:443", $errno, $errstr, 10, STREAM_CLIENT_CONNECT, $sslInfo);

            if ($socket) {
                $cert = stream_context_get_params($socket)['options']['ssl']['peer_certificate'];
                $expiryDate = Carbon::parse(openssl_x509_parse($cert)['validTo_time_t']);

                SslCertificate::updateOrCreate(
                    ['website_id' => $website->id],
                    ['expiry_date' => $expiryDate]
                );

                $this->info("Checked SSL for {$website->url} - Expiry: $expiryDate");
            } else {
                $this->error("Failed to check SSL for {$website->url}");
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Locations;
use App\Services\SeoCheckerService;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        $service = new SeoCheckerService();
        $response = $service->fetchLocations();

        if (!isset($response['tasks'][0]['result'])) return;

        foreach ($response['tasks'][0]['result'] as $loc) {
            Location::updateOrCreate(
                ['location_code' => $loc['location_code']],
                [
                    'location_name' => $loc['location_name'],
                    'country_code' => $loc['country_iso_code'] ?? null
                ]
            );
        }
    }
}

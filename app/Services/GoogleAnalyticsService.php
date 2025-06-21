<?php

namespace App\Services;

use Google\Client;
use Google\Service\AnalyticsData;
use Google\Service\AnalyticsData\RunReportReques;

class GoogleAnalyticsService
{
    protected $client;
    protected $analytics;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/google-analytics.json'));
        $this->client->addScope('https://www.googleapis.com/auth/analytics.readonly');

        $this->analytics = new AnalyticsData($this->client);
    }

    public function getTrafficData()
    {
        $propertyId = env('GA_PROPERTY_ID');

        $response = $this->analytics->properties->runReport($propertyId, [
            'dateRanges' => [['startDate' => '7daysAgo', 'endDate' => 'today']],
            'metrics' => [['name' => 'activeUsers']],
            'dimensions' => [['name' => 'date']],
        ]);

        return $response->getRows();
    }
}

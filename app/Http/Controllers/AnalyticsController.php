<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleAnalyticsService;

class AnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(GoogleAnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function showTraffic()
    {
        $trafficData = $this->analyticsService->getTrafficData();
        return view('analytics.traffic', compact('trafficData'));
    }
}

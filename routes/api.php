<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Website;
use App\Models\SslCertificate;
use Carbon\Carbon;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/get-websites', function () {
    return response()->json(Website::all());
});


Route::get('/ssl-expiry-events', function () {
    $sslCertificates = SslCertificate::with('website')->get();

    $events = [];

    foreach ($sslCertificates as $ssl) {
        $events[] = [
            'title' => 'SSL Expiry - ' . $ssl->website->name,
            'start' => $ssl->expiry_date->toDateString(),
            'color' => 'orange', // or dynamic color
            'url' => $ssl->website->url, // optional: clicking goes to website
        ];
    }

    return response()->json($events);
});
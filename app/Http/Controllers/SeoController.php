<?php

namespace App\Http\Controllers;

use App\Models\Website;
use App\Models\SeoResult;
use Illuminate\Http\Request;
use App\Services\SeoCheckerService;
use Barryvdh\DomPDF\Facade\Pdf;

class SeoController extends Controller
{
  // public function index()
  // {
  //     $websites = Website::with('seoResults')->get();
  //     return view('seo.dashboard', compact('websites'));
  // }

  public function index()
  {
    $websites = Website::with('seoResults')->get();
    return view('seo.dashboard', compact('websites'));
  }

  public function check(Request $request, SeoCheckerService $seoChecker)
  {
    $website = Website::findOrFail($request->input('website_id'));
    $seoChecker->analyze($website);
    return redirect()->route('seo.dashboard')->with('success', 'SEO Check Complete');
  }

  public function generatePDF($id)
  {
    $result = SeoResult::with('website')->findOrFail($id);
    $pdf = Pdf::loadView('seo.report_pdf', compact('result'));
    return $pdf->download('seo-report-' . $result->website->name . '.pdf');
  }

  public function redirectToGoogle()
  {
    $client = new \Google_Client();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(config('services.google.redirect'));
    $client->addScope('https://www.googleapis.com/auth/webmasters.readonly');

    return redirect()->away($client->createAuthUrl());
  }

  public function handleGoogleCallback(Request $request)
  {
    // Handle and store access token, etc.
  }
}

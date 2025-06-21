<?php

namespace App\Services;

use App\Models\SeoResult;
use SchulzeFelix\SearchConsole\Facades\SearchConsole;
use Carbon\Carbon;

class SeoAnalysisService {
  public function scan(string $site){
    $metadata = $this->checkMeta($site);
    $issues = array_filter($metadata['issues']);
    $recs = $metadata['recs'];
    $score = max(0,100 - count($issues)*10);

    SeoResult::create([
      'website_id' => auth()->id(),
      'score'=> $score,
      'issues'=> $issues,
      'recommendations'=> $recs,
      'checked_at'=> Carbon::now(),
    ]);

    return compact('score','issues','recs');
  }

  protected function checkMeta($site){
    // stub: fetch pages, parse HTML…
    return ['issues'=> ['missing meta description'], 'recs'=> ['Add <meta name="description">']];
  }

  public function chartData(){
    $data = SeoResult::where('website_id', auth()->id())
             ->orderBy('checked_at')->get(['checked_at','score'])
             ->toArray();
    return $data;
  }

  public function fetchGsc($site){
    SearchConsole::setAccessToken(session('gsc_token'));
    $period = \SchulzeFelix\SearchConsole\Period::create(now()->subDays(30), now());
    return SearchConsole::searchAnalyticsQuery(
      $site, $period, ['query','page'], [], 50
    );
  }
}

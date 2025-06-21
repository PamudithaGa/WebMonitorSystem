<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Website;
use App\Services\SeoCheckerService;


class CheckWebsiteSeo extends Command
{
    protected $signature = 'seo:check';
    protected $description = 'Run SEO check for all active websites';

    public function handle()
    {
        $websites = Website::where('status', 'active')->get();
    $seoService = new SeoCheckerService();
foreach ($websites as $website) {
        $seoService->analyze($website); // Assuming `analyze` is the correct method
        $this->info("Checked SEO for {$website->url}");
    }
    }
}

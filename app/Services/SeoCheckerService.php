<?php

// namespace App\Services;

// use App\Models\Website;
// use App\Models\SeoResult;
// use Carbon\Carbon;

// class SeoCheckerService
// {
//     public function analyze(Website $website)
//     {
//         $url = $website->url;
//         $issues = [];
//         $recommendations = [];
//         $score = 100;

//         // Fetch HTML content
//         $html = @file_get_contents($url);
//         if (!$html) {
//             $issues[] = 'Unable to fetch website content.';
//             $recommendations[] = 'Check if the site is online and accessible.';
//             $score -= 30;
//             $this->saveResult($website, $score, $issues, $recommendations);
//             return;
//         }

//         libxml_use_internal_errors(true);
//         $doc = new \DOMDocument();
//         $doc->loadHTML($html);
//         $xpath = new \DOMXPath($doc);

//         // 1. Title Tag
//         $titleTags = $doc->getElementsByTagName('title');
//         if ($titleTags->length === 0) {
//             $issues[] = 'Missing <title> tag.';
//             $recommendations[] = 'Add a descriptive title tag to your page.';
//             $score -= 5;
//         }

//         // 2. Meta Description
//         $metaDesc = $xpath->query("//meta[@name='description']");
//         if ($metaDesc->length === 0) {
//             $issues[] = 'Missing meta description.';
//             $recommendations[] = 'Add a meta description for better SEO and SERP previews.';
//             $score -= 5;
//         }

//         // 3. Canonical Tag
//         $canonical = $xpath->query("//link[@rel='canonical']");
//         if ($canonical->length === 0) {
//             $issues[] = 'Missing canonical tag.';
//             $recommendations[] = 'Include a canonical tag to avoid duplicate content.';
//             $score -= 3;
//         }

//         // 4. Heading Structure
//         $h1Tags = $doc->getElementsByTagName('h1');
//         if ($h1Tags->length === 0) {
//             $issues[] = 'Missing H1 tag.';
//             $recommendations[] = 'Add an H1 tag to define your page topic.';
//             $score -= 5;
//         }

//         // 5. URL Structure (basic check)
//         if (parse_url($url, PHP_URL_QUERY)) {
//             $issues[] = 'URL contains long query strings.';
//             $recommendations[] = 'Use clean, readable URLs.';
//             $score -= 3;
//         }

//         // 6. Mobile-Friendly (viewport check)
//         $viewport = $xpath->query("//meta[@name='viewport']");
//         if ($viewport->length === 0) {
//             $issues[] = 'Missing viewport meta tag.';
//             $recommendations[] = 'Add <meta name="viewport"> for mobile responsiveness.';
//             $score -= 5;
//         }

//         // 7. Page Speed (using remote test API would be better — here we mock)
//         $issues[] = 'Page speed score not tested.';
//         $recommendations[] = 'Use Google PageSpeed Insights for detailed performance report.';

//         // 8. Broken Links (basic internal/external link validation)
//         $links = $doc->getElementsByTagName('a');
//         $brokenCount = 0;
//         foreach ($links as $link) {
//             $href = $link->getAttribute('href');
//             if (strpos($href, 'http') === 0) {
//                 $headers = @get_headers($href);
//                 if (!$headers || strpos($headers[0], '200') === false) {
//                     $brokenCount++;
//                 }
//             }
//         }
//         if ($brokenCount > 0) {
//             $issues[] = "Found $brokenCount broken external link(s).";
//             $recommendations[] = 'Review and fix broken links to improve crawlability.';
//             $score -= min(10, $brokenCount * 2);
//         }

//         // 9. Keyword Usage – not tested here (would require NLP, skipped)
//         $issues[] = 'Keyword usage not analyzed.';
//         $recommendations[] = 'Use relevant keywords in title, headings, and content.';

//         // 10. Image Alt Tags
//         $images = $doc->getElementsByTagName('img');
//         $missingAlt = 0;
//         foreach ($images as $img) {
//             if (!$img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
//                 $missingAlt++;
//             }
//         }
//         if ($missingAlt > 0) {
//             $issues[] = "$missingAlt image(s) missing alt attributes.";
//             $recommendations[] = 'Add descriptive alt text to all images.';
//             $score -= min(5, $missingAlt);
//         }

//         // 11. Indexability – robots meta check
//         $robotsMeta = $xpath->query("//meta[@name='robots']");
//         if ($robotsMeta->length > 0) {
//             $content = strtolower($robotsMeta[0]->getAttribute('content'));
//             if (str_contains($content, 'noindex')) {
//                 $issues[] = 'Page has noindex directive.';
//                 $recommendations[] = 'Remove noindex if this page should appear in search engines.';
//                 $score -= 5;
//             }
//         }

//         // 12. HTTPS Check
//         if (parse_url($url, PHP_URL_SCHEME) !== 'https') {
//             $issues[] = 'Site is not using HTTPS.';
//             $recommendations[] = 'Use an SSL certificate for secure HTTPS connections.';
//             $score -= 5;
//         }

//         // 13. Structured Data (basic schema.org check)
//         if (strpos($html, 'schema.org') === false) {
//             $issues[] = 'No structured data (schema.org) detected.';
//             $recommendations[] = 'Add structured data for enhanced search result visibility.';
//             $score -= 5;
//         }

        

//         $this->saveResult($website, $score, $issues, $recommendations);
//     }

//     private function saveResult(Website $website, int $score, array $issues, array $recommendations)
//     {
//         SeoResult::create([
//             'website_id' => $website->id,
//             'score' => max(0, $score), // avoid negative scores
//             'issues' => $issues,
//             'recommendations' => $recommendations,
//             'checked_at' => Carbon::now(),
//         ]);
//     }
// }







namespace App\Services;

use App\Models\Website;
use App\Models\SeoResult;
use Carbon\Carbon;

class SeoCheckerService
{
    public function analyze(Website $website)
    {
        $url = $website->url;
        $targetKeyword = $website->target_keyword ?? 'seo'; // fallback keyword

        $issues = [];
        $recommendations = [];
        $score = 100;

        // Fetch HTML content
        $html = @file_get_contents($url);
        if (!$html) {
            $issues[] = 'Unable to fetch website content.';
            $recommendations[] = 'Check if the site is online and accessible.';
            $score -= 30;
            $this->saveResult($website, $score, $issues, $recommendations);
            return;
        }

        libxml_use_internal_errors(true);
        $doc = new \DOMDocument();
        $doc->loadHTML($html);
        $xpath = new \DOMXPath($doc);

        // 1. Title Tag
        $titleTags = $doc->getElementsByTagName('title');
        $titleText = $titleTags->length ? $titleTags->item(0)->textContent : '';
        if (empty($titleText)) {
            $issues[] = 'Missing <title> tag.';
            $recommendations[] = 'Add a descriptive title tag to your page.';
            $score -= 5;
        }

        // 2. Meta Description
        $metaDesc = $xpath->query("//meta[@name='description']");
        $metaText = $metaDesc->length ? $metaDesc->item(0)->getAttribute('content') : '';
        if (empty($metaText)) {
            $issues[] = 'Missing meta description.';
            $recommendations[] = 'Add a meta description for better SEO and SERP previews.';
            $score -= 5;
        }

        // 3. Canonical Tag
        $canonical = $xpath->query("//link[@rel='canonical']");
        if ($canonical->length === 0) {
            $issues[] = 'Missing canonical tag.';
            $recommendations[] = 'Include a canonical tag to avoid duplicate content.';
            $score -= 3;
        }

        // 4. Heading Structure
        $h1Tags = $doc->getElementsByTagName('h1');
        $h1Text = $h1Tags->length ? $h1Tags->item(0)->textContent : '';
        if (empty($h1Text)) {
            $issues[] = 'Missing H1 tag.';
            $recommendations[] = 'Add an H1 tag to define your page topic.';
            $score -= 5;
        }

        // 5. URL Structure (basic check)
        if (parse_url($url, PHP_URL_QUERY)) {
            $issues[] = 'URL contains long query strings.';
            $recommendations[] = 'Use clean, readable URLs.';
            $score -= 3;
        }

        // 6. Mobile-Friendly (viewport check)
        $viewport = $xpath->query("//meta[@name='viewport']");
        if ($viewport->length === 0) {
            $issues[] = 'Missing viewport meta tag.';
            $recommendations[] = 'Add <meta name="viewport"> for mobile responsiveness.';
            $score -= 5;
        }

        // 7. Page Speed (mocked)
        $issues[] = 'Page speed score not tested.';
        $recommendations[] = 'Use Google PageSpeed Insights for detailed performance report.';

        // 8. Broken Links
        $links = $doc->getElementsByTagName('a');
        $brokenCount = 0;
        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            if (strpos($href, 'http') === 0) {
                $headers = @get_headers($href);
                if (!$headers || strpos($headers[0], '200') === false) {
                    $brokenCount++;
                }
            }
        }
        if ($brokenCount > 0) {
            $issues[] = "Found $brokenCount broken external link(s).";
            $recommendations[] = 'Review and fix broken links to improve crawlability.';
            $score -= min(10, $brokenCount * 2);
        }

        // 9. Keyword Usage (actual check)
        $bodyText = strip_tags($html);
        $wordCount = str_word_count($bodyText);
        $keywordCount = substr_count(strtolower($bodyText), strtolower($targetKeyword));
        $density = $wordCount > 0 ? round(($keywordCount / $wordCount) * 100, 2) : 0;

        // Keyword presence checks
        if (!str_contains(strtolower($titleText), strtolower($targetKeyword))) {
            $issues[] = "Keyword '{$targetKeyword}' missing in title.";
            $recommendations[] = "Add '{$targetKeyword}' to the title tag.";
            $score -= 2;
        }

        if (!str_contains(strtolower($metaText), strtolower($targetKeyword))) {
            $issues[] = "Keyword '{$targetKeyword}' missing in meta description.";
            $recommendations[] = "Include '{$targetKeyword}' in the meta description.";
            $score -= 2;
        }

        if (!str_contains(strtolower($h1Text), strtolower($targetKeyword))) {
            $issues[] = "Keyword '{$targetKeyword}' missing in H1 tag.";
            $recommendations[] = "Use '{$targetKeyword}' in your main heading.";
            $score -= 2;
        }

        // Keyword density
        if ($keywordCount === 0) {
            $issues[] = "Target keyword '{$targetKeyword}' not found in content.";
            $recommendations[] = "Use '{$targetKeyword}' in the page body content.";
            $score -= 5;
        } elseif ($density > 5) {
            $issues[] = "Keyword density is too high ({$density}%).";
            $recommendations[] = "Avoid keyword stuffing. Keep density between 1–3%.";
            $score -= 3;
        } elseif ($density < 0.5) {
            $issues[] = "Keyword density is too low ({$density}%).";
            $recommendations[] = "Increase use of '{$targetKeyword}' in the content.";
            $score -= 2;
        }

        // 10. Image Alt Tags
        $images = $doc->getElementsByTagName('img');
        $missingAlt = 0;
        foreach ($images as $img) {
            if (!$img->hasAttribute('alt') || trim($img->getAttribute('alt')) === '') {
                $missingAlt++;
            }
        }
        if ($missingAlt > 0) {
            $issues[] = "$missingAlt image(s) missing alt attributes.";
            $recommendations[] = 'Add descriptive alt text to all images.';
            $score -= min(5, $missingAlt);
        }

        // 11. Indexability – robots meta check
        $robotsMeta = $xpath->query("//meta[@name='robots']");
        if ($robotsMeta->length > 0) {
            $content = strtolower($robotsMeta[0]->getAttribute('content'));
            if (str_contains($content, 'noindex')) {
                $issues[] = 'Page has noindex directive.';
                $recommendations[] = 'Remove noindex if this page should appear in search engines.';
                $score -= 5;
            }
        }

        // 12. HTTPS Check
        if (parse_url($url, PHP_URL_SCHEME) !== 'https') {
            $issues[] = 'Site is not using HTTPS.';
            $recommendations[] = 'Use an SSL certificate for secure HTTPS connections.';
            $score -= 5;
        }

        // 13. Structured Data
        if (strpos($html, 'schema.org') === false) {
            $issues[] = 'No structured data (schema.org) detected.';
            $recommendations[] = 'Add structured data for enhanced search result visibility.';
            $score -= 5;
        }

        $this->saveResult($website, $score, $issues, $recommendations);
    }

    private function saveResult(Website $website, int $score, array $issues, array $recommendations)
    {
        SeoResult::create([
            'website_id' => $website->id,
            'score' => max(0, $score),
            'issues' => $issues,
            'recommendations' => $recommendations,
            'checked_at' => Carbon::now(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebsiteLog;
use App\Models\Website;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use PDF;
use Carbon\Carbon;
use Google\Service\CloudControlsPartnerService\Console;
use Psy\Readline\Hoa\Console as HoaConsole;

class ReportController extends Controller
{

    // public function index(Request $request)
    // {
    //     $type = $request->get('type', 'daily');
    //     $dateFilter = $request->get('dateFilter');
    //     $logs = collect();

    //     if ($type === 'daily') {
    //         $targetDate = $dateFilter ? Carbon::parse($dateFilter) : Carbon::today();
    //         $logs = WebsiteLog::with('website')
    //             ->where('status', 'down')
    //             ->whereDate('created_at', $targetDate)
    //             ->get();
    //     } elseif ($type === 'weekly') {
    //         $logs = WebsiteLog::with('website')
    //             ->where('status', 'down')
    //             ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
    //             ->get();
    //     } elseif ($type === 'monthly') {
    //         $logs = WebsiteLog::with('website')
    //             ->where('status', 'down')
    //             ->whereMonth('created_at', Carbon::now()->month)
    //             ->whereYear('created_at', Carbon::now()->year)
    //             ->get();
    //     }

    //     // Group logs by website ID
    //     $groupedLogs = $logs->groupBy(function ($log) {
    //         return $log->website->id ?? 'unknown';
    //     });

    //     return view('reports.reportDashboard', [
    //         'groupedLogs' => $groupedLogs,
    //         'type' => $type,
    //         'dateFilter' => $dateFilter
    //     ]);
    // }

    public function index(Request $request)
    {
        $type = $request->get('type', 'daily');
        $dateFilter = $request->get('dateFilter');
        $weekOffset = (int) $request->get('weekOffset', 0);
        $monthOffset = (int) $request->get('monthOffset', 0);
        $logs = collect();

        if ($type === 'daily') {
            $targetDate = $dateFilter ? Carbon::parse($dateFilter) : Carbon::today();
            $logs = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereDate('created_at', $targetDate)
                ->get();
        } elseif ($type === 'weekly') {
            $startOfWeek = Carbon::now()->startOfWeek()->addWeeks($weekOffset);
            $endOfWeek = Carbon::now()->endOfWeek()->addWeeks($weekOffset);

            $logs = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->get();
        } elseif ($type === 'monthly') {
            $targetMonth = Carbon::now()->startOfMonth()->addMonths($monthOffset);

            $logs = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereMonth('created_at', $targetMonth->month)
                ->whereYear('created_at', $targetMonth->year)
                ->get();
        }

        // Group logs by website ID
        $groupedLogs = $logs->groupBy(function ($log) {
            return $log->website->id ?? 'unknown';
        });

        return view('reports.reportDashboard', [
            'groupedLogs' => $groupedLogs,
            'type' => $type,
            'dateFilter' => $dateFilter,
            'weekOffset' => $weekOffset,
            'monthOffset' => $monthOffset,
        ]);
    }


    // Daily,Weekly and Monthly reports
    // public function download(Request $request)
    // {
    //     $type = $request->get('type', 'daily');
    //     $dateFilter = $request->get('dateFilter');
    //     $logs = collect();
    //     $view = '';
    //     $data = [];

    //     if ($type === 'daily') {
    //         $targetDate = $dateFilter ? Carbon::parse($dateFilter) : Carbon::today();
    //         $yesterday = Carbon::parse($targetDate)->subDay();
    //         $todayLabel = $targetDate->format('Y-m-d');
    //         $yesterdayLabel = $yesterday->format('Y-m-d');

    //         $websites = Website::all();

    //         $logsTodayKeyed = [];
    //         $logsYesterdayKeyed = [];

    //         foreach ($websites as $website) {
    //             // Today logs
    //             $todayLogs = WebsiteLog::where('website_id', $website->id)
    //                 ->whereDate('created_at', $targetDate)
    //                 ->where('status', 'down')
    //                 ->get();

    //             $logsTodayKeyed[$website->name] = [
    //                 'down_count' => $todayLogs->count(),
    //                 'reason' => $todayLogs->isNotEmpty() ? $todayLogs->last()->error_details : 'N/A',
    //             ];

    //             // Yesterday logs
    //             $yLogs = WebsiteLog::where('website_id', $website->id)
    //                 ->whereDate('created_at', $yesterday)
    //                 ->where('status', 'down')
    //                 ->get();

    //             $logsYesterdayKeyed[$website->name] = [
    //                 'down_count' => $yLogs->count(),
    //             ];
    //         }

    //         $chartData = [];

    //         foreach ($logsTodayKeyed as $name => $todayLog) {
    //             $chartData[] = [
    //                 'label' => $name,
    //                 'today' => $todayLog['down_count'],
    //                 'yesterday' => $logsYesterdayKeyed[$name]['down_count'] ?? 0,
    //             ];
    //         }

    //         $labels = array_column($chartData, 'label');
    //         $todayCounts = array_column($chartData, 'today');
    //         $yesterdayCounts = array_column($chartData, 'yesterday');



    //         $chartConfig = [
    //             'type' => 'bar',
    //             'data' => [
    //                 'labels' => $labels,
    //                 'datasets' => [

    //                     ['label' => 'Today', 'data' => $todayCounts, 'backgroundColor' => 'blue'],
    //                     ['label' => 'Yesterday', 'data' => $yesterdayCounts, 'backgroundColor' => 'gray']
    //                 ]
    //             ],
    //             'options' => [
    //                 'plugins' => ['legend' => ['position' => 'top']],
    //                 'responsive' => true
    //             ]
    //         ];


    //         $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig));
    //         $chartBase64 = base64_encode(file_get_contents($chartUrl));

    //         // Reformat logs for view
    //         $logsToday = [];
    //         foreach ($logsTodayKeyed as $name => $log) {
    //             $logsToday[] = [
    //                 'website' => $name,
    //                 'down_count' => $log['down_count'],
    //                 'reason' => $log['reason']
    //             ];
    //         }

    //         $data = [
    //             'logs' => $logsToday,
    //             'date' => $targetDate->toFormattedDateString(),
    //             'totalWebsites' => Website::count(),
    //             'chartBase64' => $chartBase64,
    //             'todayDate' => $todayLabel,
    //             'yesterdayDate' => $yesterdayLabel,
    //         ];

    //         $view = 'reports.daily_reports';
    //     } elseif ($type === 'weekly') {
    //         $startOfWeek = Carbon::now()->startOfWeek();
    //         $endOfWeek = Carbon::now()->endOfWeek();

    //         $logs = WebsiteLog::with('website')
    //             ->where('status', 'down')
    //             ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
    //             ->get();

    //         $data = [
    //             'logs' => $logs,
    //             'period' => $startOfWeek->toFormattedDateString() . ' - ' . $endOfWeek->toFormattedDateString(),
    //         ];

    //         $view = 'reports.weekly_reports';
    //     } elseif ($type === 'monthly') {
    //         $month = Carbon::now()->format('F Y');

    //         $logs = WebsiteLog::with('website')
    //             ->where('status', 'down')
    //             ->whereMonth('created_at', Carbon::now()->month)
    //             ->whereYear('created_at', Carbon::now()->year)
    //             ->get();

    //         $data = [
    //             'logs' => $logs,
    //             'month' => $month,
    //         ];

    //         $view = 'reports.monthly_reports';
    //     }

    //     return PDF::loadView($view, $data)->download("NexusMonitor_{$type}_report_{$dateFilter}.pdf");
    // }

    public function download(Request $request)
    {
        $type = $request->get('type', 'daily');
        $dateFilter = $request->get('dateFilter');
        $weekOffset = (int) $request->get('weekOffset', 0);
        $monthOffset = (int) $request->get('monthOffset', 0);

        $logs = collect();
        $view = '';
        $data = [];

        if ($type === 'daily') {
            $targetDate = $dateFilter ? Carbon::parse($dateFilter) : Carbon::today();
            $yesterday = Carbon::parse($targetDate)->subDay();
            $todayLabel = $targetDate->format('Y-m-d');
            $yesterdayLabel = $yesterday->format('Y-m-d');

            $websites = Website::all();
            $logsTodayKeyed = [];
            $logsYesterdayKeyed = [];

            foreach ($websites as $website) {
                $todayLogs = WebsiteLog::where('website_id', $website->id)
                    ->whereDate('created_at', $targetDate)
                    ->where('status', 'down')
                    ->get();

                $logsTodayKeyed[$website->name] = [
                    'down_count' => $todayLogs->count(),
                    'reason' => $todayLogs->isNotEmpty() ? $todayLogs->last()->error_details : 'N/A',
                ];

                $yLogs = WebsiteLog::where('website_id', $website->id)
                    ->whereDate('created_at', $yesterday)
                    ->where('status', 'down')
                    ->get();

                $logsYesterdayKeyed[$website->name] = [
                    'down_count' => $yLogs->count(),
                ];
            }

            $chartData = [];
            foreach ($logsTodayKeyed as $name => $todayLog) {
                $chartData[] = [
                    'label' => $name,
                    'today' => $todayLog['down_count'],
                    'yesterday' => $logsYesterdayKeyed[$name]['down_count'] ?? 0,
                ];
            }

            $labels = array_column($chartData, 'label');
            $todayCounts = array_column($chartData, 'today');
            $yesterdayCounts = array_column($chartData, 'yesterday');

            $chartConfig = [
                'type' => 'bar',
                'data' => [
                    'labels' => $labels,
                    'datasets' => [
                        ['label' => $yesterdayLabel, 'data' => $yesterdayCounts, 'backgroundColor' => 'gray'],
                        ['label' => $todayLabel, 'data' => $todayCounts, 'backgroundColor' => 'blue']
                    ]
                ],
                'options' => [
                    'plugins' => ['legend' => ['position' => 'top']],
                    'responsive' => true
                ]
            ];

            $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($chartConfig));
            $chartBase64 = base64_encode(file_get_contents($chartUrl));

            $logsToday = [];
            foreach ($logsTodayKeyed as $name => $log) {
                $logsToday[] = [
                    'website' => $name,
                    'down_count' => $log['down_count'],
                    'reason' => $log['reason']
                ];
            }

            $data = [
                'logs' => $logsToday,
                'date' => $targetDate->toFormattedDateString(),
                'totalWebsites' => Website::count(),
                'chartBase64' => $chartBase64,
                'todayDate' => $todayLabel,
                'yesterdayDate' => $yesterdayLabel,
            ];

            $view = 'reports.daily_reports';
        } elseif ($type === 'weekly') {
            $startOfWeek = Carbon::now()->startOfWeek()->addWeeks($weekOffset);
            $endOfWeek = Carbon::now()->endOfWeek()->addWeeks($weekOffset);

            $logs = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->get();

            $data = [
                'logs' => $logs,
                'period' => $startOfWeek->toFormattedDateString() . ' - ' . $endOfWeek->toFormattedDateString(),
            ];

            $view = 'reports.weekly_reports';
        } elseif ($type === 'monthly') {
            $targetMonth = Carbon::now()->startOfMonth()->addMonths($monthOffset);
            $prevMonth = $targetMonth->copy()->subMonth();

            // Current and previous month logs
            $logs = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereMonth('created_at', $targetMonth->month)
                ->whereYear('created_at', $targetMonth->year)
                ->get();

            $logsPrevMonth = WebsiteLog::with('website')
                ->where('status', 'down')
                ->whereMonth('created_at', $prevMonth->month)
                ->whereYear('created_at', $prevMonth->year)
                ->get();

            // Group by website
            $grouped = $logs->groupBy(fn($log) => $log->website->name ?? 'N/A');
            $groupedPrev = $logsPrevMonth->groupBy(fn($log) => $log->website->name ?? 'N/A');

            // For Pie Chart - Downtime % Share This Month
            $pieLabels = [];
            $pieCounts = [];
            $totalDowntime = $logs->count();

            foreach ($grouped as $website => $siteLogs) {
                $pieLabels[] = $website;
                $pieCounts[] = round(($siteLogs->count() / max($totalDowntime, 1)) * 100, 2); // avoid /0
            }
            // Generate distinct colors for each website
            $colors = [
                '#3366cc',
                '#dc3912',
                '#ff9900',
                '#109618',
                '#990099',
                '#0099c6',
                '#dd4477',
                '#66aa00',
                '#b82e2e',
                '#316395',
                '#994499',
                '#22aa99',
                '#aaaa11',
                '#6633cc',
                '#e67300',
                '#8b0707',
                '#651067',
                '#329262',
                '#5574a6',
                '#3b3eac'
            ];

            $backgroundColors = [];
            for ($i = 0; $i < count($pieLabels); $i++) {
                $backgroundColors[] = $colors[$i % count($colors)];
            }


            $pieChartConfig = [
                'type' => 'outlabeledPie',
                'data' => [
                    'labels' => $pieLabels,
                    'datasets' => [
                        [
                            'data' => $pieCounts,
                            'backgroundColor' => $backgroundColors,
                        ]
                    ]
                ],
                'options' => [
                    'plugins' => [
                        "legend" => false,

                        'outlabels' => [
                            'text' => '%l: %v%',
                            'color' => '#000',
                            'font' => [
                                'resizable' => true,
                                'minSize' => 10,
                                'maxSize' => 14
                            ]
                        ],

                        // ✅ Optional title
                        'title' => [
                            'display' => true,
                            'text' => 'Monthly Downtime Distribution (%)',
                            'color' => '#000'
                        ]
                    ]
                ]
            ];

            $pieChartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($pieChartConfig)) . '&plugins=outlabels';
            $pieChartBase64 = base64_encode(file_get_contents($pieChartUrl));

            // For Bar Chart - Compare with Previous Month
            $barLabels = [];
            $currentCounts = [];
            $previousCounts = [];

            $allWebsites = $grouped->keys()->merge($groupedPrev->keys())->unique()->values();

            foreach ($allWebsites as $website) {
                $barLabels[] = $website;
                $currentCounts[] = $grouped[$website]->count() ?? 0;
                $previousCounts[] = $groupedPrev[$website]->count() ?? 0;
            }

            $barChartConfig = [
                'type' => 'bar',
                'data' => [
                    'labels' => $barLabels,
                    'datasets' => [
                        ['label' => $targetMonth->format('F'), 'data' => $currentCounts, 'backgroundColor' => 'blue'],
                        ['label' => $prevMonth->format('F'), 'data' => $previousCounts, 'backgroundColor' => 'gray'],
                    ]
                ],
                'options' => [
                    'responsive' => true,
                    'plugins' => ['legend' => ['position' => 'top']],
                ]
            ];

            $barChartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($barChartConfig));
            $barChartBase64 = base64_encode(file_get_contents($barChartUrl));

            $data = [
                'logs' => $logs,
                'month' => $targetMonth->format('F Y'),
                'pieChartBase64' => $pieChartBase64,
                'barChartBase64' => $barChartBase64,
            ];

            $view = 'reports.monthly_reports';
        }


        return PDF::loadView($view, $data)->download("NexusMonitor_{$type}_report.pdf");
    }
}

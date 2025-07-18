<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SEO Report - {{ $result->website->name }}</title>
    {{-- <style>
        body {
            font-family: 'Arial', sans-serif;
            background-image: url('{{ public_path('pdf_template.jpg') }}');
            background-size: cover;
            background-position: center;
            color: #333;
        }

        h1 {
            margin-top: 40px;

        }

        h1,
        h2,
        h3 {

            margin-bottom: 10px;
        }

        .header {
            border-bottom: 2px solid #222;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .meta {
            font-size: 14px;
            margin-bottom: 30px;
        }

        .score-box {
            background-color: #e8f5e9;
            border-left: 6px solid #4caf50;
            padding: 15px;
            margin-bottom: 30px;
            display: inline-block;
        }

        .score-box span {
            font-size: 28px;
            font-weight: bold;
            color: #2e7d32;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h3 {
            border-left: 4px solid #2196f3;
            padding-left: 10px;
            margin-bottom: 10px;
        }

        ul {
            list-style: disc;
            padding-left: 30px;
            margin-top: 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
        }

        .col {
            width: 48%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            padding: 6px 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        footer {
            margin-top: 50px;
            font-size: 12px;
            text-align: center;
            color: #777;
        }

        .badge {
            display: inline-block;
            padding: 4px 8px;
            font-size: 12px;
            background: #f1f1f1;
            border-radius: 4px;
            margin-left: 10px;
        }

        .page-break {
            page-break-before: always;
        }

        .div {
            margin-top: 30px;
        }
    </style> --}}
    <!-- Inside <head> -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-image: url('{{ public_path('pdf_template.jpg') }}');
        background-size: cover;
        background-position: center;
        color: #1f2937; /* slate-800 */
        margin: 0;
        padding: 40px;
    }

    h1 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
        color: #111827; /* gray-900 */
    }

    h2, h3 {
        font-weight: 600;
        margin-bottom: 12px;
        color: #1f2937;
    }

    .header {
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .meta {
        font-size: 14px;
        color: #6b7280; /* gray-500 */
        margin-bottom: 30px;
    }

    .score-box {
        background-color: #ecfdf5;
        border: 2px solid #10b981;
        color: #047857;
        padding: 20px;
        border-radius: 12px;
        text-align: center;
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 40px;
    }

    .score-box span {
        font-size: 36px;
        display: block;
        margin-top: 8px;
    }

    .section {
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 10px;
        padding: 24px;
        margin-bottom: 40px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    ul {
        list-style: disc;
        padding-left: 20px;
        margin-top: 0;
        font-size: 14px;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .col {
        flex: 1 1 45%;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 14px;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    footer {
        margin-top: 60px;
        font-size: 12px;
        text-align: center;
        color: #9ca3af;
    }

    .badge {
        display: inline-block;
        padding: 4px 10px;
        font-size: 12px;
        background: #f3f4f6;
        border-radius: 9999px;
        color: #374151;
        margin-left: 10px;
    }

    .page-break {
        page-break-before: always;
    }

    .keyword-chip {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 500;
        color: #111827;
        background-color: #e0f2fe;
    }

    .keyword-missing {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .keyword-unknown {
        background-color: #fef9c3;
        color: #92400e;
    }

    .keyword-present {
        background-color: #d1fae5;
        color: #065f46;
    }

    .keyword-row {
        margin-bottom: 12px;
    }
</style>

</head>

<body>
    <div class="header">
        <h1>SEO Audit Report</h1>
        <p class="meta">
            <strong>Website:</strong> {{ $result->website->name }} ({{ $result->website->url }})<br>
            <strong>Date Checked:</strong> {{ \Carbon\Carbon::parse($result->checked_at)->format('F d, Y H:i') }}
        </p>
    </div>

    <div class="score-box">
        Overall SEO Score: <span>{{ $result->score }}</span> / 100
    </div>


    @php
        $keyword = $result->website->target_keyword ?? 'N/A';
        $density = 0;
        $keywordAnalysis = [
            'Title' => 'Unknown',
            'Meta Description' => 'Unknown',
            'H1 Tag' => 'Unknown',
            'Body Content' => 'Unknown',
        ];

        foreach ($result->issues as $issue) {
            if (str_contains($issue, 'Keyword') && str_contains($issue, 'title')) {
                $keywordAnalysis['Title'] = 'Missing';
            }
            if (str_contains($issue, 'Keyword') && str_contains($issue, 'meta')) {
                $keywordAnalysis['Meta Description'] = 'Missing';
            }
            if (str_contains($issue, 'Keyword') && str_contains($issue, 'H1')) {
                $keywordAnalysis['H1 Tag'] = 'Missing';
            }
            if (str_contains($issue, 'keyword') && str_contains($issue, 'not found')) {
                $keywordAnalysis['Body Content'] = 'Missing';
            }
            if (str_contains($issue, 'density')) {
                preg_match('/\(([\d\.]+)%\)/', $issue, $matches);
                $density = $matches[1] ?? 0;
            }
        }

        // Keyword chip color logic
        // function keywordChip($status)
        // {
        //     $color = match ($status) {
        //         'Missing' => '#f87171', // red-400
        //         'Unknown' => '#facc15', // yellow-400
        //         default => '#4ade80', // green-400 (assume present)
        //     };

        //     return "<span style='display:inline-block;padding:4px 8px;border-radius:9999px;font-size:12px;background:$color;color:#000;'>$status</span>";
        // }
        function keywordChip($status)
{
    $class = match ($status) {
        'Missing' => 'keyword-chip keyword-missing',
        'Unknown' => 'keyword-chip keyword-unknown',
        default => 'keyword-chip keyword-present',
    };

    return "<span class='$class'>$status</span>";
}

    @endphp

    <div class="section">
        <h3>Keyword Analysis</h3>
        <p><strong>Target Keyword:</strong> {{ $keyword }}</p>
        <p><strong>Keyword Density:</strong> {{ $density }}%</p>

        <div style="margin-top: 20px;">
            @foreach ($keywordAnalysis as $section => $status)
                <div style="margin-bottom: 12px;">
                    <strong style="display:block;margin-bottom:4px;">{{ $section }}</strong>
                    {!! keywordChip($status) !!}
                </div>
            @endforeach
        </div>
    </div>

    <div class="page-break"></div>
    <div class="div">
        <div class="row section">
            <div class="col">
                <h3>Issues Found</h3>
                <ul>
                    @forelse ($result->issues as $issue)
                        <li>{{ $issue }}</li>
                    @empty
                        <li>No critical issues found.</li>
                    @endforelse
                </ul>
            </div>

            <div class="col">
                <h3>Recommendations</h3>
                <ul>
                    @forelse ($result->recommendations as $rec)
                        <li>{{ $rec }}</li>
                    @empty
                        <li>Everything looks good! 🎉</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>



    <footer>
        This report was generated by NexusMonitor

    </footer>
</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Website Monitoring Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ public_path('pdf_template.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .container {
            position: relative;
            padding: 50px;
            text-align: center;
        }

        h1 {
            margin-top: 40px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
            font-size: 14px;
        }

        td {
            background-color: #fff;
        }

        .page-break {
            page-break-before: always;
        }

        .table-section {
            margin-top: 0;
        }

        .page-break+.table-section {
            margin-top: 40px;
        }


        .charts {
            margin-top: 70px
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Monthly Website Monitoring Report</h1>
        <p>Month: {{ $month }}</p>

        @php
            use Illuminate\Support\Str;
            $grouped = $logs->groupBy(fn($log) => $log->website->name ?? 'N/A');
        @endphp
        <div class="table-section">
            <table>
                <thead style="background-color: #222052; color: #fff;">
                    <tr>
                        <th>No</th>
                        <th>Website Name</th>
                        <th>No. of Downtimes</th>
                        <th>Reason(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grouped as $websiteName => $siteLogs)
                        @php
                            $errorCounts = [];
                            foreach ($siteLogs as $log) {
                                $reason = $log->error_details ?? '-';

                                $friendly = match (true) {
                                    Str::contains($reason, 'cURL error 6') => 'Couldn’t Resolve Host',
                                    Str::contains($reason, 'cURL error 7') => 'Failed to Connect to Host',
                                    Str::contains($reason, 'cURL error 28') => 'Responded Time Out',
                                    Str::contains($reason, 'cURL error 35') => 'SSL Connect Error',
                                    Str::contains($reason, 'cURL error 51') => 'SSL Certificate Verification Failed',
                                    Str::contains($reason, 'cURL error 52') => 'Empty Response from Server',
                                    Str::contains($reason, 'cURL error 56') => 'Receive Error',
                                    Str::contains($reason, 'cURL error 60')
                                        => 'SSL Certificate Problem (CA Cert Missing)',
                                    default => $reason,
                                };

                                $errorCounts[$friendly] = ($errorCounts[$friendly] ?? 0) + 1;
                            }
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $websiteName }}</td>
                            <td>{{ $siteLogs->count() }}</td>
                            <td>
                                <ul class="list-inside list-disc text-sm">
                                    @foreach ($errorCounts as $error => $count)
                                        <li>{{ $error }} ({{ $count }})</li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>
        <div class="charts">
            @if (isset($pieChartBase64))
                <h3>Monthly Downtime Distribution (%)</h3>
                <img src="data:image/png;base64,{{ $pieChartBase64 }}" alt="Pie Chart"
                    style="max-width: 100%; height: auto; margin-bottom: 40px;">
            @endif

            @if (isset($barChartBase64))
                <h3>Monthly Downtime Comparison</h3>
                <img src="data:image/png;base64,{{ $barChartBase64 }}" alt="Bar Chart"
                    style="max-width: 100%; height: auto;">
            @endif


            <p style="text-align: center; margin-top: 0px; font-size: 10px;">Prepared by Nexus Monitor</p>
        </div>
</body>

</html> --}}



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Monthly Website Monitoring Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ public_path('pdf_template.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .container {
            position: relative;
            padding: 50px;
            text-align: center;
        }

        h1 {
            margin-top: 40px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #222052;
            color: #fff;
            display: table-header-group;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
            font-size: 14px;

        }

        td {
            background-color: #fff;
        }

        ul {
            padding-left: 16px;
            margin: 0;
        }

        .page-break {
            page-break-before: always;
        }

        .charts {
            margin-top: 70px;
        }

        .footer {
            text-align: center;
            margin-top: 0px;
            font-size: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Monthly Website Monitoring Report</h1>
        <p>Month: {{ $month }}</p>

        @php
            use Illuminate\Support\Str;
            $grouped = $logs->groupBy(fn($log) => $log->website->name ?? 'N/A');
        @endphp

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Website Name</th>
                    <th>No. of Downtimes</th>
                    <th>Reason(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $websiteName => $siteLogs)
                    @php
                        $errorCounts = [];
                        foreach ($siteLogs as $log) {
                            $reason = $log->error_details ?? '-';

                            $friendly = match (true) {
                                Str::contains($reason, 'cURL error 6') => 'Couldn’t Resolve Host',
                                Str::contains($reason, 'cURL error 7') => 'Failed to Connect to Host',
                                Str::contains($reason, 'cURL error 28') => 'Responded Time Out',
                                Str::contains($reason, 'cURL error 35') => 'SSL Connect Error',
                                Str::contains($reason, 'cURL error 51') => 'SSL Certificate Verification Failed',
                                Str::contains($reason, 'cURL error 52') => 'Empty Response from Server',
                                Str::contains($reason, 'cURL error 56') => 'Receive Error',
                                Str::contains($reason, 'cURL error 60') => 'SSL Certificate Problem (CA Cert Missing)',
                                default => $reason,
                            };

                            $errorCounts[$friendly] = ($errorCounts[$friendly] ?? 0) + 1;
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $websiteName }}</td>
                        <td>{{ $siteLogs->count() }}</td>
                        <td>
                            <ul>
                                @foreach ($errorCounts as $error => $count)
                                    <li>{{ $error }} ({{ $count }})</li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="page-break"></div>

        <div class="charts">
            @if (isset($pieChartBase64))
                <h3>Monthly Downtime Distribution (%)</h3>
                <img src="data:image/png;base64,{{ $pieChartBase64 }}" alt="Pie Chart"
                    style="max-width: 100%; height: auto; margin-bottom: 40px;">
            @endif

            @if (isset($barChartBase64))
                <h3>Monthly Downtime Comparison</h3>
                <img src="data:image/png;base64,{{ $barChartBase64 }}" alt="Bar Chart"
                    style="max-width: 100%; height: auto;">
            @endif

            <p class="footer">Prepared by Nexus Monitor</p>
        </div>
    </div>
</body>

</html>

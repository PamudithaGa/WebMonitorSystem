{{-- <!DOCTYPE html>
<html>
<head>
    <title>Weekly Website Monitoring Report</title>
 <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('{{ public_path("pdf_template.jpg") }}');
            background-size: cover;
            background-position: center;
        }
        .container {
            position: relative;
            padding: 50px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
    </head>
<body>
    <h1>Weekly Website Monitoring Report</h1>
    <p>Period: {{ $period }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Website</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($logs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $log->website->name ?? 'N/A' }}</td>
                    <td>{{ $log->error_details ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="text-align: end">Powered by Nexus Monitor</p>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Weekly Website Monitoring Report</title>
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
            padding: 10px;
            text-align: left;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Weekly Website Monitoring Report</h1>
        <p>Period: {{ $period }}</p>

        <!-- Downtime Table -->
        @php
            use Illuminate\Support\Str;

            $grouped = $logs->groupBy(fn($log) => $log->website->name ?? 'N/A');
        @endphp

        <table>
            <thead style="background-color: #222052; color: #fff;">
                <tr>
                    <th>No</th>
                    <th>Website Name</th>
                    <th>Reason(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grouped as $websiteName => $siteLogs)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $websiteName }}</td>
                        <td>
                            @php
                                $errorCounts = [];

                                foreach ($siteLogs as $log) {
                                    $reason = $log->error_details ?? '-';

                                    $friendly = match (true) {
                                        Str::contains($reason, 'cURL error 6') => 'Couldn’t Resolve Host',
                                        Str::contains($reason, 'cURL error 7') => 'Failed to Connect to Host',
                                        Str::contains($reason, 'cURL error 28') => 'Responded Time Out',
                                        Str::contains($reason, 'cURL error 35') => 'SSL Connect Error',
                                        Str::contains($reason, 'cURL error 51')
                                            => 'SSL Certificate Verification Failed',
                                        Str::contains($reason, 'cURL error 52') => 'Empty Response from Server',
                                        Str::contains($reason, 'cURL error 56') => 'Receive Error',
                                        Str::contains($reason, 'cURL error 60')
                                            => 'SSL Certificate Problem (CA Cert Missing)',
                                        default => $reason,
                                    };

                                    $errorCounts[$friendly] = ($errorCounts[$friendly] ?? 0) + 1;
                                }
                            @endphp

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

        <p style="text-align: center; margin-top: 30px; font-size: 10px;">Prepared by Nexus Monitor</p>

    </div>
</body>

</html>

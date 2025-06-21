<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daily Website Monitoring Report</title>
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

        .chart {
            margin: 30px auto;
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Daily Website Monitoring Report</h1>
        <p>Date: {{ $date }} | <strong>Total Websites Monitored:</strong> {{ $totalWebsites }}</p>

        <!-- Downtime Table -->
        <table>
            <thead style="background-color: #222052; color: #fff;">
                <tr>
                    <th>No</th>
                    <th>Website Name</th>
                    <th>No. of Downtimes</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $log['website'] }}</td>
                        <td>{{ $log['down_count'] }}</td>
                        <td>
                            @php
                                $reason = $log['reason'];
                                echo match (true) {
                                    str_contains($reason, 'cURL error 6') => 'Couldn’t Resolve Host',
                                    str_contains($reason, 'cURL error 7') => 'Failed to Connect to Host',
                                    str_contains($reason, 'cURL error 28') => 'Responded Time Out',
                                    str_contains($reason, 'cURL error 35') => 'SSL Connect Error',
                                    str_contains($reason, 'cURL error 51') => 'SSL Certificate Verification Failed',
                                    str_contains($reason, 'cURL error 52') => 'Empty Response from Server',
                                    str_contains($reason, 'cURL error 56') => 'Receive Error',
                                    str_contains($reason, 'cURL error 60')
                                        => 'SSL Certificate Problem (CA Cert Missing)',
                                    default => $reason,
                                };
                            @endphp
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>

        <!-- Comparison Chart -->
        @if (isset($chartBase64))
            <div class="chart">
                <h3>Downtime Comparison</h3>
                <h4>{{ $yesterdayDate }} vs {{ $todayDate }}</h4>
                <img src="data:image/png;base64,{{ $chartBase64 }}" alt="Downtime Chart"
                    style="max-width: 100%; height: auto;">
            </div>
        @endif

        <p style="text-align: center; margin-top: 30px; font-size: 10px;">Prepared by Nexus Monitor</p>

    </div>
</body>

</html>

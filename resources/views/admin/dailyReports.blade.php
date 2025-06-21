<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Website Downtime Summary</title>
</head>
<body style="font-family: 'Arial', sans-serif; font-size: 12px; margin: 20px; padding: 10px;">

    <img src="{{ asset('img/aioh_blue.png') }}" alt="ccds" style="height: 100px">


    
    <h2 style="text-align: center; color: #333; font-size: 20px; font-weight: bold; margin-bottom: 10px;">
        Daily Website Downtime Summary
    </h2>

    <table style="width: 100%; border-collapse: collapse; font-size: 12px; margin-top: 10px;">
        <thead>
            <tr style="background-color: #0073e6; color: #fff; text-align: left;">
                <th style="border: 1px solid #ccc; padding: 8px;">No</th>
                <th style="border: 1px solid #ccc; padding: 8px;">Website Name</th>
                <th style="border: 1px solid #ccc; padding: 8px;">No. of Downtimes</th>
                <th style="border: 1px solid #ccc; padding: 8px;">Reason</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @foreach (App\Models\Website::all() as $website)
                @php
                    $downLogs = App\Models\WebsiteLog::where('website_id', $website->id)
                        ->where('status', 'down')
                        ->get();
                    $downCount = $downLogs->count();
                    $reason = $downLogs->isNotEmpty() ? $downLogs->last()->error_details : 'N/A';
                @endphp
                <tr style="background-color: {{ $count % 2 == 0 ? '#f9f9f9' : '#ffffff' }};">
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $count++ }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $website->name }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $downCount }}</td>
                    <td style="border: 1px solid #ccc; padding: 8px;">{{ $reason }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>

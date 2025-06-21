@extends('layout2')

@section('content')
    <div class="container">
        <h1>SEO Dashboard</h1>
        <h2>Overall Score: <span id="seo-score">{{ $score }}%</span></h2>

        <canvas id="trendChart"></canvas>

        <h3>Critical Issues</h3>
        <ul>
            @foreach ($issues as $i)
                <li><strong>[{{ ucfirst($i['severity']) }}]</strong> <a href="{{ $i['page'] }}">{{ $i['page'] }}</a>:
                    {{ $i['title'] }}</li>
            @endforeach
        </ul>

        <h3>Recommendations</h3>
        <ul>
            {{-- @foreach ($recs as $issue => $rec)
                <li><strong>{{ $issue }}:</strong> {{ $rec }}</li>
            @endforeach --}}
            @foreach ($recommendations as $issue => $rec)
                <li><strong>{{ $issue }}:</strong> {{ $rec }}</li>
            @endforeach

        </ul>

        @if ($trafficTrend)
            <h3>Organic Traffic (last 30d)</h3>
            <canvas id="trafficChart"></canvas>

            <h3>Top Keywords</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Keyword</th>
                        <th>Clicks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topKeywords as $k)
                        <tr>
                            <td>{{ $k['query'] }}</td>
                            <td>{{ $k['clicks'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h3>Top Pages</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Page</th>
                        <th>Clicks</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topPages as $p)
                        <tr>
                            <td>{{ $p['page'] }}</td>
                            <td>{{ $p['clicks'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <a href="{{ route('seo.gsc.connect') }}" class="btn btn-primary">Connect Google Search Console</a>
        @endif

        <a href="{{ route('seo.export') }}" class="btn btn-secondary mt-3">Export PDF Report</a>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('trendChart'), {
            type: 'doughnut',
            data: {
                labels: ['On‑Page', 'Performance'],
                datasets: [{
                    data: [{{ $score }}, {{ 100 - $score }}],
                    backgroundColor: ['#4caf50', '#e0e0e0']
                }]

            }
        });
        @if ($trafficTrend)
            new Chart(document.getElementById('trafficChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode(array_column($trafficTrend, 'date')) !!},
                    datasets: [{
                        label: 'Clicks',
                        data: {!! json_encode(array_column($trafficTrend, 'clicks')) !!},
                        borderColor: '#2196f3',
                        fill: false
                    }]
                }
            });
        @endif
    </script>
@endsection

@extends('layout2')

@section('content')
<div class="container mx-auto mt-16 px-4">
    <h2 class="mb-6 text-2xl font-bold">🌐 SEO Dashboard</h2>

    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($websites as $site)
            @php
                $latest = $site->seoResults->last();
            @endphp

            <div class="rounded-2xl bg-white p-5 shadow-md">
                <div class="mb-2 flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $site->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $site->url }}</p>
                    </div>
                    @if($latest)
                        <div class="text-center">
                            <div class="relative h-12 w-12">
                                <svg class="absolute h-full w-full text-green-500" viewBox="0 0 36 36">
                                    <path class="text-gray-200" d="M18 2.0845...Z" fill="currentColor" />
                                    <path d="M18 2.0845...Z" fill="currentColor" style="stroke-dasharray: 100, 100; stroke-dashoffset: {{ 100 - $latest->score }}" />
                                </svg>
                                <div class="absolute inset-0 flex items-center justify-center text-sm font-bold">{{ $latest->score }}</div>
                            </div>
                            <p class="text-xs text-gray-500">Score</p>
                        </div>
                    @endif
                </div>

                @if($latest)
                    <div class="mt-3 space-y-2">
                        <details class="rounded bg-red-50 p-2 text-red-600">
                            <summary class="cursor-pointer font-medium">❌ Issues Found</summary>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($latest->issues as $issue)
                                    <li>{{ $issue }}</li>
                                @endforeach
                            </ul>
                        </details>

                        <details class="rounded bg-green-50 p-2 text-green-600">
                            <summary class="cursor-pointer font-medium">✅ Recommendations</summary>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach ($latest->recommendations as $rec)
                                    <li>{{ $rec }}</li>
                                @endforeach
                            </ul>
                        </details>

                        <a href="{{ route('seo.report.pdf', $latest->id) }}" class="mt-3 inline-block rounded bg-blue-600 px-4 py-2 text-sm text-white transition hover:bg-blue-700">
                            📄 Download PDF Report
                        </a>
                    </div>
                @else
                    <p class="text-gray-500">No SEO check performed yet.</p>
                @endif

                <form method="POST" action="{{ route('seo.check') }}" class="mt-4">
                    @csrf
                    <input type="hidden" name="website_id" value="{{ $site->id }}">
                    <button class="w-full rounded bg-green-600 px-4 py-2 text-white transition hover:bg-green-700">
                        🔄 Run SEO Check
                    </button>
                </form>

                @if ($site->seoResults->count() > 1)
                <div class="mt-6">
                    <canvas id="scoreChart-{{ $site->id }}" height="100"></canvas>
                </div>
                @endif
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @foreach ($websites as $site)
        @if ($site->seoResults->count() > 1)
        const ctx{{ $site->id }} = document.getElementById('scoreChart-{{ $site->id }}').getContext('2d');
        new Chart(ctx{{ $site->id }}, {
            type: 'line',
            data: {
                labels: @json($site->seoResults->pluck('checked_at')->map(fn($d) => \Carbon\Carbon::parse($d)->format('M d'))),
                datasets: [{
                    label: 'SEO Score History',
                    data: @json($site->seoResults->pluck('score')),
                    fill: false,
                    borderColor: '#22c55e',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
        @endif
    @endforeach
</script>
@endsection

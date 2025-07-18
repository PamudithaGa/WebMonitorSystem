@extends('layout')

@section('content')
    <div class="container mx-auto mt-[60px] p-6">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">SEO Monitor</h1>
                <p class="text-sm text-gray-600">Track SSL & SEO scores with real-time checks and suggestions.</p>
            </div>
        </div>


        <div class="overflow-x-auto p-4">
            <form method="GET" action="{{ route('seo.dashboard') }}" class="rounded-xl bg-white p-4 shadow-md">
                <input type="text" name="search" placeholder="🔍 Search websites..." value="{{ request('search') }}"
                    class="h-12 w-full rounded-md border border-gray-300 px-4 shadow-sm transition focus:border-red-600 focus:ring focus:ring-red-400" />
        </div>


        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($websites as $site)
                @php
                    $latest = $site->seoResults?->last();
                    $score = $latest?->score ?? 0;
                    $scoreColor = $score >= 80 ? 'text-green-500' : ($score >= 50 ? 'text-yellow-500' : 'text-red-500');
                    $lastChecked = $latest?->checked_at
                        ? \Carbon\Carbon::parse($latest->checked_at)->diffForHumans()
                        : 'Never';
                @endphp

                <div class="rounded-2xl bg-white p-6 shadow-xl transition hover:shadow-2xl">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">{{ $site->name }}</h3>
                            <p class="text-sm text-blue-600 underline">{{ $site->url }}</p>
                            <span class="mt-1 inline-block text-xs text-gray-500">Last Checked: {{ $lastChecked }}</span>
                        </div>
                        @if ($latest)
                            <div class="text-center">
                                <div class="relative h-14 w-14">
                                    <svg class="absolute h-full w-full" viewBox="0 0 36 36">
                                        <path d="M18 2.0845
                                                                             a 15.9155 15.9155 0 0 1 0 31.831
                                                                             a 15.9155 15.9155 0 0 1 0 -31.831"
                                            fill="none" stroke="#e5e7eb" stroke-width="3.8" />
                                        <path d="M18 2.0845
                                                                             a 15.9155 15.9155 0 0 1 0 31.831"
                                            fill="none"
                                            stroke="{{ $score >= 80 ? '#22c55e' : ($score >= 50 ? '#facc15' : '#ef4444') }}"
                                            stroke-width="3.8" stroke-dasharray="{{ $score }}, 100"
                                            stroke-linecap="round" />
                                    </svg>
                                    <div
                                        class="absolute inset-0 flex items-center justify-center text-sm font-bold text-gray-700">
                                        {{ $score }}</div>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">SEO Score</p>
                            </div>
                        @endif
                    </div>

                    @if ($latest)
                        <div class="space-y-3">
                            <details class="rounded bg-red-50 p-3 text-red-600">
                                <summary class="cursor-pointer font-semibold">❌ Issues Found</summary>
                                <ul class="mt-2 list-disc pl-5 text-sm">
                                    @foreach ($latest->issues as $issue)
                                        <li>{{ $issue }}</li>
                                    @endforeach
                                </ul>
                            </details>

                            <details class="rounded bg-green-50 p-3 text-green-600">
                                <summary class="cursor-pointer font-semibold">✅ Recommendations</summary>
                                <ul class="mt-2 list-disc pl-5 text-sm">
                                    @foreach ($latest->recommendations as $rec)
                                        <li>{{ $rec }}</li>
                                    @endforeach
                                </ul>
                            </details>

                            <a href="{{ route('seo.report.pdf', $latest->id) }}"
                                class="mt-2 inline-block w-full rounded-lg bg-blue-600 px-4 py-2 text-center text-sm text-white transition hover:bg-blue-700">
                                📄 Download PDF Report
                            </a>
                        </div>
                    @else
                        <p class="mt-4 text-sm italic text-gray-500">No SEO scan available yet.</p>
                    @endif

                    <form method="POST" action="{{ route('seo.check') }}" class="mt-4">
                        @csrf
                        <input type="hidden" name="website_id" value="{{ $site->id }}">
                        <button
                            class="w-full rounded-lg bg-green-600 px-4 py-2 text-sm text-white transition hover:bg-green-700">
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
                            label: 'SEO Score',
                            data: @json($site->seoResults->pluck('score')),
                            fill: false,
                            borderColor: '#3b82f6',
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
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

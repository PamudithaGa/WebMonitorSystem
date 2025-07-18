@extends('layout')

@section('content')
    <div class="container mx-auto mt-[60px] p-6">
        <!-- Page Header -->
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Report Dashboard</h1>
                <p class="text-sm text-gray-600">
                    Generate and view daily, weekly, and monthly system-performance reports.
                </p>
            </div>
        </div>

        <!-- Report Category Tabs -->
        <div class="mb-6 flex gap-4">
            @php $type = request('type', 'daily'); @endphp

            <a href="?type=daily"
               class="px-4 py-2 text-sm font-medium rounded shadow-sm transition
                      {{ $type === 'daily' ? 'bg-blue-600 text-white' : 'bg-blue-100 text-blue-700 hover:bg-blue-200' }}">
                Daily Report
            </a>

            <a href="?type=weekly"
               class="px-4 py-2 text-sm font-medium rounded shadow-sm transition
                      {{ $type === 'weekly' ? 'bg-green-600 text-white' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                Weekly Report
            </a>

            <a href="?type=monthly"
               class="px-4 py-2 text-sm font-medium rounded shadow-sm transition
                      {{ $type === 'monthly' ? 'bg-purple-600 text-white' : 'bg-purple-100 text-purple-700 hover:bg-purple-200' }}">
                Monthly Report
            </a>
        </div>

        <!-- Navigation Buttons for Week/Month -->
        @if ($type === 'weekly' || $type === 'monthly')
            @php
                $offsetKey = $type === 'weekly' ? 'weekOffset' : 'monthOffset';
                $offset = request($offsetKey, 0);
                $baseParams = request()->except($offsetKey);
            @endphp

            <div class="mb-4 flex justify-end gap-2">
                <a href="{{ route('report.index', array_merge($baseParams, ['type' => $type, $offsetKey => $offset - 1])) }}"
                   class="rounded bg-gray-100 px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">
                    ← Previous {{ ucfirst($type) }}
                </a>

                @if ($offset < 0)
                    <a href="{{ route('report.index', array_merge($baseParams, ['type' => $type, $offsetKey => $offset + 1])) }}"
                       class="rounded bg-gray-100 px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">
                        Next {{ ucfirst($type) }} →
                    </a>
                @endif
            </div>
        @endif

        <!-- Report Table Card -->
        <div class="rounded-lg bg-white p-4 shadow">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ ucfirst($type) }} Report - Downtime Logs
                    </h2>
                    @if ($type === 'weekly')
                        <p class="mt-1 text-sm text-gray-600">
                            Week of {{ \Carbon\Carbon::now()->startOfWeek()->addWeeks($weekOffset)->toFormattedDateString() }}
                        </p>
                    @elseif ($type === 'monthly')
                        <p class="mt-1 text-sm text-gray-600">
                            {{ \Carbon\Carbon::now()->startOfMonth()->addMonths($monthOffset)->format('F Y') }}
                        </p>
                    @elseif ($type === 'daily' && $dateFilter)
                        <p class="mt-1 text-sm text-gray-600">Date: {{ \Carbon\Carbon::parse($dateFilter)->toFormattedDateString() }}</p>
                    @endif
                </div>

                <!-- Filter + Print -->
                <div class="flex items-center gap-3">
                    @if ($type === 'daily')
                        <!-- Filter Form -->
                        <form method="GET" action="{{ route('report.index') }}" class="flex items-center gap-2">
                            <input type="hidden" name="type" value="{{ $type }}">
                            <label for="dateFilter" class="text-sm text-gray-600">Date:</label>
                            <input type="date" id="dateFilter" name="dateFilter" value="{{ request('dateFilter') }}"
                                   class="rounded border px-2 py-1 text-sm">
                            <button type="submit"
                                    class="rounded bg-gray-100 px-3 py-1 text-sm text-gray-700 hover:bg-gray-200">
                                Filter
                            </button>
                        </form>
                    @endif

                    <!-- Print Form -->
                    <form method="GET" action="{{ route('report.download') }}">
                        <input type="hidden" name="type" value="{{ $type }}">
                        <input type="hidden" name="dateFilter" value="{{ request('dateFilter') }}">
                        <input type="hidden" name="weekOffset" value="{{ request('weekOffset') }}">
                        <input type="hidden" name="monthOffset" value="{{ request('monthOffset') }}">
                        @csrf
                        <button type="submit"
                                class="rounded bg-indigo-600 px-4 py-2 text-white shadow hover:bg-indigo-700">
                            Print&nbsp;Report
                        </button>
                    </form>
                </div>
            </div>

            <!-- Report Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr class="text-left">
                            <th class="border p-2 font-medium text-gray-700">#</th>
                            <th class="border p-2 font-medium text-gray-700">Website</th>
                            <th class="border p-2 font-medium text-gray-700">Reason</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($groupedLogs as $logs)
                            <tr class="transition hover:bg-gray-50">
                                <td class="border p-2">{{ $loop->iteration }}</td>
                                <td class="border p-2">{{ $logs->first()->website->name ?? 'N/A' }}</td>
                                <td class="border p-2">
                                    <ul class="list-inside list-disc text-sm text-gray-700">
                                        @php
                                            $errorCounts = [];

                                            foreach ($logs as $log) {
                                                $reason = $log->error_details ?? '-';

                                                if (Str::contains($reason, 'cURL error 6')) {
                                                    $friendly = 'Couldn’t Resolve Host';
                                                } elseif (Str::contains($reason, 'cURL error 7')) {
                                                    $friendly = 'Failed to Connect to Host';
                                                } elseif (Str::contains($reason, 'cURL error 28')) {
                                                    $friendly = 'Responded Time Out';
                                                } elseif (Str::contains($reason, 'cURL error 35')) {
                                                    $friendly = 'SSL Connect Error';
                                                } elseif (Str::contains($reason, 'cURL error 51')) {
                                                    $friendly = 'SSL Certificate Verification Failed';
                                                } elseif (Str::contains($reason, 'cURL error 52')) {
                                                    $friendly = 'Empty Response from Server';
                                                } elseif (Str::contains($reason, 'cURL error 56')) {
                                                    $friendly = 'Receive Error';
                                                } elseif (Str::contains($reason, 'cURL error 60')) {
                                                    $friendly = 'SSL Certificate Problem (CA Cert Missing)';
                                                } else {
                                                    $friendly = $reason;
                                                }

                                                $errorCounts[$friendly] = ($errorCounts[$friendly] ?? 0) + 1;
                                            }
                                        @endphp

                                        @foreach ($errorCounts as $error => $total)
                                            <li>{{ $error }} ({{ $total }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="border p-4 text-center text-gray-500">
                                    No records found for the selected period.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layout2')

@section('content')
    <div class="mt-[160px] bg-red-700 px-6 lg:px-20">

        <div class="overflow-x-auto p-4 text-left">
            <p class="text-4xl font-semibold text-gray-800">📈 SEO Dashboard</p>
            <p class="mt-2 text-lg text-gray-500">
                Monitor your website’s search engine performance and health with real-time SEO metrics.
            </p>
        </div>

        <div class="overflow-x-auto p-4">
            <form method="POST" action="{{ route('seo.check') }}" class="flex flex-col gap-4 md:flex-row">
                @csrf
                <select name="website_id" class="h-12 w-full rounded-md border border-gray-300 px-4 shadow-sm md:w-1/2">
                    @foreach ($websites as $website)
                        <option value="{{ $website->id }}">{{ $website->url }}</option>
                    @endforeach
                </select>
                <button type="submit"
                    class="h-12 w-full rounded-md bg-blue-600 px-6 text-white transition hover:bg-blue-800 md:w-auto">
                    Run SEO Check
                </button>
            </form>
        </div>

        <div class="overflow-x-auto p-4">
            <table class="min-w-full rounded-lg border border-gray-200 bg-white shadow-lg">
                <thead class="bg-gray-100 text-lg uppercase">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Website</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Organic Traffic</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Traffic Value</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Site Score</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Last Checked</th>
                        <th class="px-6 py-4 text-left font-semibold text-gray-700">Report</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($seoReports as $report)
                        <tr class="border-b bg-white transition hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-800">{{ $report->website->name }}</td>
                            <td class="px-6 py-4 text-gray-800">{{ $report->organic_traffic }}</td>
                            <td class="px-6 py-4 text-gray-800">${{ number_format($report->traffic_value, 2) }}</td>
                            {{-- <td class="px-6 py-4 text-gray-800">{{ $report->site_score ?? 'N/A' }}/100</td> --}}
                            <td class="px-6 py-4 text-gray-800">
                                {{ $report->site_score ? $report->site_score . '/100' : 'N/A' }}
                            </td>

                            <td class="px-6 py-4 text-gray-800">{{ $report->last_checked->format('d M Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('seo.pdf', $report->id) }}"
                                    class="rounded-md bg-green-600 px-4 py-2 text-white transition hover:bg-green-800">
                                    Download PDF
                                </a>
                            </td>
                        </tr>

                        <tr class="bg-gray-50">
                            <td colspan="6" class="px-6 pb-4 pt-2 text-sm text-gray-600">
                               
                                <div>
                                    <strong>🔧 Critical Issues:</strong>
                                    @if (!empty($report->critical_issues))
                                        <ul class="mt-2 list-disc pl-5 text-sm text-red-600">
                                            @foreach ($report->critical_issues as $issue)
                                                <li>{{ $issue }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="italic text-gray-400">None detected.</p>
                                    @endif
                                </div>

                                <div>
                                    <strong>💡 Recommendations:</strong>
                                    @if (!empty($report->recommendations))
                                        <ul class="mt-2 list-disc pl-5 text-sm text-yellow-600">
                                            @foreach ($report->recommendations as $tip)
                                                <li>{{ $tip }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="italic text-gray-400">No recommendations available.</p>
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

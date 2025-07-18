@extends('layout')

@section('content')
<div class="container mx-auto mt-[60px] p-6">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">SSL Certificate Monitor</h1>
            <p class="text-sm text-gray-600">
                Keep track of website SSL certificates and get alerts before they expire.
            </p>
        </div>
    </div>

    {{-- Search Input --}}
    <div class="overflow-x-auto p-4">
        <input
            id="search-input"
            type="search"
            placeholder="🔍 Search Website or Expiry Date"
            class="h-12 w-full rounded-md border border-gray-300 px-4 shadow-sm transition focus:border-red-600 focus:ring focus:ring-red-400" />
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto p-4">
        <table class="min-w-full rounded-lg border border-gray-200 bg-white shadow-lg">
            <thead class="bg-gray-100 text-lg uppercase">
                <tr>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700">Website</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700">Expiry Date</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700">Remaining Days</th>
                    <th class="px-6 py-4 text-left font-semibold text-gray-700">Alert Status</th>
                    @auth
                        @if (Auth::user()->email === 'achintha@gmail.com')
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">SSL Status</th>
                        @endif
                    @endauth
                </tr>
            </thead>
            <tbody id="ssl-table-body">
                @foreach (App\Models\SslCertificate::all() as $ssl)
                    <tr class="searchable-row border-b bg-white transition hover:bg-gray-50">
                        <td class="px-6 py-4 text-lg text-gray-800">{{ $ssl->website_name }}</td>
                        <td class="px-6 py-4 text-lg text-gray-800">{{ $ssl->expiry_date->toDateString() }}</td>
                        <td class="px-6 py-4 text-lg text-gray-800">
                            <span class="font-semibold text-red-600">
                                {{ round(now()->diffInDays($ssl->expiry_date)) }} Days
                            </span>
                        </td>
                        <td class="px-6 py-4 text-lg">
                            @php
                                $alertStatus = $ssl->alert_sent;
                                $alertColors = [
                                    0 => 'bg-green-100 text-green-600',
                                    1 => 'bg-green-100 text-green-600',
                                    2 => 'bg-green-100 text-green-600',
                                    3 => 'bg-yellow-100 text-yellow-600',
                                    4 => 'bg-orange-100 text-orange-700',
                                    5 => 'bg-red-100 text-red-700',
                                ];
                            @endphp
                            <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $alertColors[$alertStatus] }}">
                                {{ $ssl->alert_sent }}
                            </span>
                        </td>

                        @auth
                            @if (Auth::user()->email === 'pamudithagangana45@gmail.com' && $ssl->alert_sent >= 3)
                                <td class="px-6 py-4">
                                    <button class="rounded-md bg-red-600 px-4 py-2 text-white transition hover:bg-red-800">
                                        Active SSL
                                    </button>
                                </td>
                            @endif
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Search Script --}}
<script>
    document.getElementById('search-input').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        const rows = document.querySelectorAll('.searchable-row');

        rows.forEach(row => {
            // Combine all cell texts in row for search
            const rowText = row.innerText.toLowerCase();
            row.style.display = rowText.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endsection

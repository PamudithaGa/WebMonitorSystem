@extends('layout2')

@section('content')
    <div class="mt-[60px] px-6 lg:px-20">

        <div class="overflow-x-auto p-4 text-left">
            <p class="text-4xl font-semibold text-gray-800">🔒 SSL Certificate Monitor</p>
            <p class="mt-2 text-lg text-gray-500">
                Keep track of website SSL certificates and get alerts before they expire.
            </p>
        </div>

        <div class="overflow-x-auto p-4">
            <input type="search" placeholder="🔍 Search Website"
                class="h-12 w-full rounded-md border border-gray-300 px-4 shadow-sm transition focus:border-red-600 focus:ring focus:ring-red-400" />
        </div>

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
                <tbody>
                    @foreach (App\Models\SslCertificate::all() as $ssl)
                        <tr class="border-b bg-white transition hover:bg-gray-50">
                            <td class="px-6 py-4 text-lg text-gray-800">{{ $ssl->name }}</td>
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
                                @if (Auth::user()->email === 'achintha@gmail.com' && $ssl->alert_sent >= 3)
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
@endsection

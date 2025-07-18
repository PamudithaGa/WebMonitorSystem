{{-- @extends('layout')

@section('content')
    <div>
        <div class="mt-[60px] grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-5">
            <div
                class="relative col-span-2 row-span-2 transform overflow-hidden rounded-lg bg-[#222052] p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-users"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-white">Total Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::count() }}
                </p>

            </div>

            <div class="relative transform overflow-hidden rounded-lg bg-[#EEE5D3] p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-check-circle"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-[#D2B68A]">Running Websites</h3>
                <p class="text-3xl font-bold text-[#D2B68A]">
                    {{ App\Models\Website::where('status', 'active')->count() }}

                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-red-500 to-red-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-times-circle"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-white">Down Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::where('status', 'down')->count() }}
                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-spinner"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-white">Pending Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::where('status', 'Pending')->count() }}
                </p>
            </div>

            <div class="relative transform overflow-hidden rounded-lg bg-[#D2B68A] p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-globe"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-white">Members</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::count() }}
                </p>
            </div>
        </div>

        <div class="lg:grid-row-4 grid grid-cols-1 gap-6 bg-red-300 p-6 md:grid-cols-2 lg:grid-cols-3">

            @php
                $yesterdayLogs = App\Models\WebsiteLog::whereDate('created_at', now()->subDay());
                $totalLogs = $yesterdayLogs->count();
                $errors = $yesterdayLogs->whereNotNull('error_details')->count();
            @endphp

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-file-alt"></i></div>
                <h3 class="cursor-pointor text-lg font-semibold text-white"> <a href="{{ route('report.index') }}">
                        Download Reports</a></h3>
                <p class="text-3xl font-bold text-white"></p>
            </div>

            <div class="bg-red-600">2</div>

            <div class="row-span-2 bg-pink-900">
                <div class="mx-auto max-w-sm rounded-xl border border-gray-200 bg-white p-4 shadow-md">
                    <input id="flat-calendar" class="hidden" />
                    <div id="calendar-container" class="flatpickr-calendar"></div>
                </div>
            </div>
        </div>


    </div>
@endsection




@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-calendar {
            box-shadow: none !important;
            border: none;
            width: 100%;
        }

        .flatpickr-day {
            width: 36px;
            height: 36px;
            line-height: 36px;
            border-radius: 9999px;
            margin: 2px;
            font-weight: 500;
        }

        .flatpickr-day.today {
            background-color: #34d399;
            color: white;
        }

        .flatpickr-months {
            display: flex;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: #10b981;
        }

        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: #9ca3af;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#calendar-container", {
                inline: true,
                defaultDate: new Date(),
                disableMobile: true
            });
        });
    </script>
@endsection --}}



@extends('layout')

@section('content')
<div class="mt-[60px] grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-5">

    {{-- Total Websites --}}
    <div class="relative transform overflow-hidden rounded-lg bg-gray-800 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-globe"></i></div>
        <h3 class="text-lg font-semibold text-white">Total Websites</h3>
        <p class="text-3xl font-bold text-white">
            {{ App\Models\Website::count() }}
        </p>
    </div>

    {{-- Running Websites --}}
    <div class="relative transform overflow-hidden rounded-lg bg-green-600 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-check-circle"></i></div>
        <h3 class="text-lg font-semibold text-white">Running Websites</h3>
        <p class="text-3xl font-bold text-white">
            {{ App\Models\Website::where('status', 'active')->count() }}
        </p>
    </div>

    {{-- Down Websites --}}
    <div class="relative transform overflow-hidden rounded-lg bg-red-600 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-times-circle"></i></div>
        <h3 class="text-lg font-semibold text-white">Down Websites</h3>
        <p class="text-3xl font-bold text-white">
            {{ App\Models\Website::where('status', 'down')->count() }}
        </p>
    </div>

    {{-- Pending Websites --}}
    <div class="relative transform overflow-hidden rounded-lg bg-yellow-500 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-spinner"></i></div>
        <h3 class="text-lg font-semibold text-white">Pending Websites</h3>
        <p class="text-3xl font-bold text-white">
            {{ App\Models\Website::where('status', 'Pending')->count() }}
        </p>
    </div>

    {{-- Members --}}
    <div class="relative transform overflow-hidden rounded-lg bg-blue-500 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-users"></i></div>
        <h3 class="text-lg font-semibold text-white">Members</h3>
        <p class="text-3xl font-bold text-white">
            {{ App\Models\Website::count() }}
        </p>
    </div>
</div>

{{-- Second Section --}}
<div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">

    {{-- Reports --}}
    <div class="relative transform overflow-hidden rounded-lg bg-indigo-600 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-file-alt"></i></div>
        <h3 class="text-lg font-semibold text-white">Download Reports</h3>
        <a href="{{ route('report.index') }}" class="mt-4 inline-block rounded bg-white px-4 py-2 text-sm font-semibold text-indigo-600 hover:bg-gray-100">
            📥 View All Reports
        </a>
    </div>

    {{-- Error Logs (Optional Upgrade) --}}
    @php
        $yesterdayLogs = App\Models\WebsiteLog::whereDate('created_at', now()->subDay());
        $totalLogs = $yesterdayLogs->count();
        $errors = $yesterdayLogs->whereNotNull('error_details')->count();
    @endphp

    <div class="relative transform overflow-hidden rounded-lg bg-pink-600 p-6 shadow-lg transition hover:scale-105">
        <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-exclamation-triangle"></i></div>
        <h3 class="text-lg font-semibold text-white">Yesterday's Errors</h3>
        <p class="text-3xl font-bold text-white">{{ $errors }}</p>
        <p class="mt-1 text-sm text-pink-100">Out of {{ $totalLogs }} checks</p>
    </div>

    {{-- Calendar Widget --}}
    <div class="row-span-2">
        <div class="mx-auto max-w-sm rounded-xl border border-gray-200 bg-white p-4 shadow-md">
            <h3 class="mb-2 text-center text-lg font-semibold text-gray-700"> Calendar</h3>
            <input id="flat-calendar" class="hidden" />
            <div id="calendar-container" class="flatpickr-calendar"></div>
        </div>
    </div>

    {{-- SEO Dashboard --}}
<div class="relative transform overflow-hidden rounded-lg bg-purple-700 p-6 shadow-lg transition hover:scale-105">
    <div class="absolute right-2 top-2 text-5xl text-white opacity-20"><i class="fas fa-search"></i></div>
    <h3 class="text-lg font-semibold text-white">SEO Dashboard</h3>
    <a href="{{ route('seo.dashboard') }}" class="mt-4 inline-block rounded bg-white px-4 py-2 text-sm font-semibold text-purple-700 hover:bg-gray-100">
        🚀 Go to SEO Dashboard
    </a>
</div>


</div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-calendar {
            box-shadow: none !important;
            border: none;
            width: 100%;
        }

        .flatpickr-day {
            width: 36px;
            height: 36px;
            line-height: 36px;
            border-radius: 9999px;
            margin: 2px;
            font-weight: 500;
        }

        .flatpickr-day.today {
            background-color: #34d399;
            color: white;
        }

        .flatpickr-months {
            display: flex;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            color: #10b981;
        }

        .flatpickr-prev-month,
        .flatpickr-next-month {
            color: #9ca3af;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr("#calendar-container", {
                inline: true,
                defaultDate: new Date(),
                disableMobile: true
            });
        });
    </script>
@endsection

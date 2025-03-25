@extends('layout2')

@section('content')
    <div>
        <div class="mt-[60px] grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-4">
            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-globe"></i></div>
                <h3 class="text-lg font-semibold text-white">Total Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::count() }}
                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-green-500 to-green-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-check-circle"></i></div>
                <h3 class="text-lg font-semibold text-white">Running Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::where('status', 'active')->count() }}

                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-red-500 to-red-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-times-circle"></i></div>
                <h3 class="text-lg font-semibold text-white">Down Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::where('status', 'down')->count() }}
                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-yellow-500 to-yellow-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-spinner"></i></div>
                <h3 class="text-lg font-semibold text-white">Pending Websites</h3>
                <p class="text-3xl font-bold text-white">
                    {{ App\Models\Website::where('status', 'Pending')->count() }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-4">

            @php
                $yesterdayLogs = App\Models\WebsiteLog::whereDate('created_at', now()->subDay());
                $totalLogs = $yesterdayLogs->count();
                $errors = $yesterdayLogs->whereNotNull('error_details')->count();
            @endphp

            <div
                class="relative col-span-8 transform overflow-hidden rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-chart-line"></i>
                </div>
                <h3 class="text-lg font-semibold text-white">Yesterday Summary</h3>
                <p class="text-3xl font-bold text-white">
                    Total Logs: {{ $totalLogs }} <br>
                    Errors: {{ $errors }}
                </p>
            </div>

            <div
                class="relative transform overflow-hidden rounded-lg bg-gradient-to-r from-blue-500 to-blue-700 p-6 shadow-lg hover:scale-105">
                <div class="absolute right-2 top-2 text-6xl text-white opacity-20"><i class="fas fa-file-alt"></i></div>
                <h3 class="text-lg font-semibold text-white">More Reports</h3>
                <p class="text-3xl font-bold text-white"></p>
            </div>
        </div>
    </div>


    
@endsection

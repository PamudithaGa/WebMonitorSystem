@extends('layout2')

@section('content')
    <div class="mt-[60px] grid w-full grid-cols-1 gap-6 p-6 lg:grid-cols-4">
        <div>
            <input type="number" placeholder="Enter page count"
                class="w-full rounded-md border border-gray-300 p-2 text-black focus:border-blue-400 focus:ring-2 focus:ring-blue-400"
                value={{ App\Models\Website::count() }} readonly>
        </div>

        <div class="flex items-center gap-2">
            <button class="rounded-md bg-gray-200 px-4 py-2 hover:bg-gray-300">Filter</button>
            <select name="filter_by"
                class="rounded-md border border-gray-300 p-2 text-black focus:border-blue-400 focus:ring-2 focus:ring-blue-400">
                <option value="status">Status</option>
                <option value="type">Type</option>
                <option value="name">Name</option>
                <option value="last_check">Last Check</option>
                <option value="last_update">Last Update</option>
            </select>
        </div>

        <div class="flex items-center">
            <button id="add-website-button"
                class="flex items-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                <i class="fa fa-plus mr-2"></i> New Monitor
            </button>
        </div>
    </div>

    <div id="add-website-form" class="hidden">
        <h1>Add Website</h1>
        <form action="/add-website" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="">Website Name</label>
                    <input type="text" name="name" placeholder="Type Website Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="client">Client</label>
                    <input type="text" name="client" placeholder="Type Client Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label for="client">URL</label>
                    <input type="text" name="url" placeholder="Type URL here"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-between space-x-4">
                <button type="button" id="cancel-button"
                    class="w-full rounded-lg bg-gray-300 py-3 text-gray-700 transition duration-200 ease-in-out hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
                <button type="submit"
                    class="w-full rounded-lg bg-blue-600 py-3 text-white transition duration-200 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add</button>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    <div class="mt-6 w-full">
        <div class="w-[1200px] rounded-xl bg-gray-600 p-6 text-white shadow-md">
            <p class="text-lg font-semibold">Monitoring Status</p>

            @if (App\Models\Website::all()->isEmpty())
                <p class="text-lg font-bold">No Data Yet</p>
            @else
                <ul>
                    @foreach (App\Models\Website::all() as $website)
                        <li class="mt-2 flex justify-between border-b pb-2">
                            <span>{{ $website->name }}</span>
                            {{-- <span>  {{ $website->url }}</span> --}}
                            <a href="{{ $website->url }}" target="_blank" class="text-blue-500 hover:underline">
                                {{ $website->url }}
                            </a>
                            
    
                            <span
                                class="font-bold 
                            {{ $website->status === 'Down' ? 'text-red-400' : 'text-green-400' }}">
                                {{ $website->status ? $website->status : 'No Status Available' }}
                            </span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <script>
        document.getElementById('add-website-button').addEventListener('click', function() {
            var form = document.getElementById('add-website-form');
            form.classList.toggle('hidden');
        });

        function fetchMonitoringData() {
            fetch('/api/get-websites')
                .then(response => response.json())
                .then(data => {
                    let statusContainer = document.getElementById('monitoring-status');
                    statusContainer.innerHTML = "";

                    data.forEach(website => {
                        let statusClass = website.status === 'Active' ? 'text-green-400' : 'text-red-400';
                        statusContainer.innerHTML += `<li class="mt-2 flex justify-between border-b pb-2">
                        <span>${website.name} (${website.url})</span>
                        <span class="font-bold ${statusClass}">${website.status}</span>
                    </li>`;
                    });
                });
        }

        setInterval(fetchMonitoringData, 60000);
    </script>

@endsection

@extends('layout')

@section('content')
<div class="mt-[60px] space-y-10 p-6">

    {{-- 🧠 Header Section --}}
    <div class="flex flex-col justify-between gap-4 md:flex-row md:items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Monitoring Status</h1>
            <p class="text-sm text-gray-600">
                Generate and view daily, weekly, and monthly system-performance reports.
            </p>
        </div>
        <div class="flex justify-end">
            <button id="add-website-button"
                class="flex items-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                <i class="fa fa-plus"></i> New Monitor
            </button>
        </div>
    </div>

    {{-- ➕ Add Website Form --}}
    <div id="add-website-form" class="hidden rounded-lg bg-white p-6 shadow-md">
        <h2 class="mb-4 text-xl font-semibold text-gray-700">Add Website</h2>
        <form action="/add-website" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Website Name</label>
                    <input type="text" name="name" placeholder="Type Website Name"
                        class="w-full rounded border border-gray-300 bg-gray-100 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Client</label>
                    <input type="text" name="client" placeholder="Type Client Name"
                        class="w-full rounded border border-gray-300 bg-gray-100 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">URL</label>
                    <input type="text" name="url" placeholder="Type URL here"
                        class="w-full rounded border border-gray-300 bg-gray-100 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <button type="button" id="cancel-button"
                    class="rounded bg-gray-300 px-5 py-2 text-sm text-gray-700 hover:bg-gray-400">
                    Cancel
                </button>
                <button type="submit"
                    class="rounded bg-blue-600 px-5 py-2 text-sm text-white hover:bg-blue-700">
                    Add
                </button>
            </div>

            @if ($errors->any())
                <div class="mt-4 rounded bg-red-100 p-3 text-sm text-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>

    {{-- 🔍 Search Input --}}
    <div class="rounded-lg bg-white p-4 shadow-md">
        <input type="text" id="search-input" placeholder="🔍 Search websites by name or URL..."
            class="w-full rounded-md border border-gray-300 bg-gray-100 p-3 text-sm text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500">
    </div>

    {{-- 🖥️ Monitoring Table --}}
    <div class="overflow-x-auto rounded-xl bg-gray-800 p-6 text-white shadow-md">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-gray-700 text-left">
                    <th class="p-2 font-semibold">Website</th>
                    <th class="p-2 font-semibold">URL</th>
                    <th class="p-2 font-semibold">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse (App\Models\Website::all() as $website)
                    <tr class="searchable-row border-b border-gray-700" 
                        data-name="{{ strtolower($website->name) }}"
                        data-url="{{ strtolower($website->url) }}">
                        <td class="p-2">{{ $website->name }}</td>
                        <td class="p-2">
                            <a href="{{ $website->url }}" target="_blank"
                                class="text-blue-400 hover:underline">
                                Visit
                            </a>
                        </td>
                        <td class="p-2">
                            <span
                                class="font-bold {{ $website->status === 'Down' ? 'text-red-400' : 'text-green-400' }}">
                                {{ $website->status ?? 'No Status Available' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-300">No websites monitored yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- 🧠 JS Section --}}
<script>
    document.getElementById('add-website-button').addEventListener('click', () => {
        document.getElementById('add-website-form').classList.toggle('hidden');
    });

    document.getElementById('cancel-button').addEventListener('click', () => {
        document.getElementById('add-website-form').classList.add('hidden');
    });

    document.getElementById('search-input').addEventListener('input', function () {
        const keyword = this.value.toLowerCase();
        document.querySelectorAll('.searchable-row').forEach(row => {
            const name = row.getAttribute('data-name');
            const url = row.getAttribute('data-url');
            row.style.display = name.includes(keyword) || url.includes(keyword) ? '' : 'none';
        });
    });
</script>
@endsection

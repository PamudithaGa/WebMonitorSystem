@extends('layout2')

@section('content')
    <div class="mt-[60px] grid w-full grid-cols-1 gap-6 p-6 lg:grid-cols-4">
        <div>
            <input type="number" placeholder="Enter page count"
                class="w-full rounded-md border border-gray-300 p-2 text-black focus:border-blue-400 focus:ring-2 focus:ring-blue-400"
                value="{{ old('page_count') }}" readonly>
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
            <button class="flex items-center rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                <i class="fa fa-plus mr-2"></i> New Monitor
            </button>
        </div>
    </div>

    <div class="mt-6 w-full">
        <div class="flex w-[1200px] items-center justify-between rounded-xl bg-gray-600 p-6 text-white shadow-md">
            <p class="text-lg font-semibold">Monitoring Status</p>
            <p class="text-lg font-bold">No Data Yet</p>
        </div>
    </div>
@endsection

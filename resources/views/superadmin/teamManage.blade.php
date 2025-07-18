{{-- @extends('layout')

@section('content')
    <div class="w-full bg-white p-6 md:mt-[100px] md:p-6">
        <div
            class="mb-4 mt-6 flex flex-col items-center justify-between rounded-xl bg-white/90 p-6 shadow-lg backdrop-blur-md lg:flex-row">
            <h1 class="text-3xl font-extrabold text-gray-800 lg:text-4xl">Team Management Dashboard</h1>

            <div class="mt-4 flex flex-col items-center lg:mt-0 lg:flex-row lg:space-x-6">
                <div class="flex items-center space-x-4">
                    <div class="h-12 w-12 overflow-hidden rounded-full border-2 border-gray-300">
                        <img src="https://i.pravatar.cc/150?img=3" alt="User Avatar" class="h-full w-full object-cover">
                    </div>
                    <div class="text-left">
                        <p class="text-lg font-semibold text-gray-700">Welcome, <span
                                class="text-indigo-600">{{ Auth::user()->name }}</span>!</p>
                        <p class="text-sm text-gray-500">ID: <span class="font-medium">{{ Auth::user()->id }}</span></p>
                        <p class="text-sm text-gray-500">Email: <span class="font-medium">{{ Auth::user()->email }}</span>
                        </p>
                    </div>
                </div>

                <button
                    class="mt-4 rounded-lg bg-gradient-to-r from-red-600 to-red-800 px-5 py-2 text-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg lg:mt-0">
                    Logout
                </button>
            </div>
        </div>

        <div class="grid gap-4 px-6 pb-5 sm:grid-cols-3 md:grid-cols-4">
            <input type="search" placeholder="Find Site"
                class="w-full rounded-lg border border-blue-600 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />

            <select name="Sort By"
                class="w-full rounded-lg border border-gray-300 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">Sort by ID</option>
                <option value="">Sort by Name</option>
                <option value="">Sort by Added Date</option>
            </select>

            @auth
                @if (Auth::user()->email === 'parindya@gmail.com')
                    <button id="add-website-button"
                        class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                        + Add Website
                    </button>
                @endif
            @endauth

            @auth
                @if (Auth::user()->email === 'parindya@gmail.com')
                    <button id="add-member-btn"
                        class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                        + Add Members
                    </button>
                @endif
            @endauth
        </div>

        <div id="add-member-card"
            class="mx-auto mt-6 hidden w-full max-w-lg rounded-xl border border-gray-200 bg-white p-8 shadow-xl">
            <h1 class="mb-6 text-center text-3xl font-semibold text-gray-800">Add Member</h1>

            <form action="/add-member" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" name="name" placeholder="Type New Member Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" placeholder="Type Email"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Role</label>
                    <select name="role"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="flex justify-between space-x-4">
                    <button type="button" id="cancel-button"
                        class="w-full rounded-lg bg-gray-300 py-3 text-gray-700 transition duration-200 ease-in-out hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 py-3 text-white transition duration-200 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Add</button>
                </div>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div id="add-website-form" class="hidden">
            <h1>Add Website</h1>
            <form action="/add-website" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600">Website Name</label>
                    <input type="text" name="name" placeholder="Type Website Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <label for="client">Client</label>
                    <input type="text" name="client" placeholder="Type Client Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <label for="client">URL</label>
                    <input type="text" name="url" placeholder="Type URL here"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
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
        <div class="w-full cursor-pointer gap-4 rounded-lg border border-blue-600 bg-white p-3 px-6 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
            onclick="toggleMembers()">
            Members
        </div>

        <div id="members-list" class="grid hidden w-3/4 grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (App\Models\User::where('role', 'user')->get() as $user)
                <div
                    class="flex flex-col items-center justify-center rounded-lg border border-gray-900 bg-white p-4 shadow-md transition duration-300 ease-in-out hover:shadow-xl">

                    <p class="text-lg font-semibold text-gray-700">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-7 w-full cursor-pointer gap-4 rounded-lg border border-blue-600 bg-white p-3 px-6 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
            onclick="toggleSites()">
            Websites
        </div>

        <div id="sites-list" class="grid w-full gap-6 px-6 py-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            @foreach (App\Models\Website::all() as $website)
                <div
                    class="relative flex h-auto flex-col items-center justify-center rounded-xl border border-gray-300 bg-white p-6 shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                    <p class="text-xl font-semibold text-gray-800">{{ $website->name }}</p>
                    <a href="{{ $website->url }}" class="mt-1 text-sm text-gray-600">{{ $website->url }}</a>
                    <div class="my-3 h-[1px] w-full bg-gray-200"></div>

                    <div class="flex w-full justify-between">
                        <button
                            class="rounded-md bg-blue-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-600">
                            Edit
                        </button>
                        <form action="{{ route('website.destroy', $website->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="rounded-md bg-red-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>


        <style>
            .team-card:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const memberFields = document.querySelector("#memberFields");

                function updateDisabledOptions() {
                    let selectedValues = Array.from(document.querySelectorAll(".member-select"))
                        .map(select => select.value)
                        .filter(val => val !== "");

                    document.querySelectorAll(".member-select option").forEach(option => {
                        if (selectedValues.includes(option.value)) {
                            option.disabled = true;
                        } else {
                            option.disabled = false;
                        }
                    });
                }

                document.querySelector(".add-member").addEventListener("click", function() {
                    let firstField = document.querySelector(".member-row");
                    let newField = firstField.cloneNode(true);

                    newField.querySelector("select").value = "";

                    newField.querySelector(".add-member").remove();
                    let removeButton = document.createElement("button");
                    removeButton.type = "button";
                    removeButton.className =
                        "remove-member inline-flex items-center rounded-md bg-red-500 px-3 py-1.5 text-white hover:bg-red-600";
                    removeButton.textContent = "-";
                    newField.appendChild(removeButton);

                    memberFields.appendChild(newField);

                    updateDisabledOptions();
                });

                document.addEventListener("click", function(e) {
                    if (e.target.classList.contains("remove-member")) {
                        e.target.parentElement.remove();
                        updateDisabledOptions();
                    }
                });

                document.addEventListener("change", function(e) {
                    if (e.target.classList.contains("member-select")) {
                        updateDisabledOptions();
                    }
                });
            });

            function toggleMembers() {
                const membersList = document.getElementById('members-list');
                membersList.classList.toggle('hidden');
            }

            function toggleSites() {
                const sitesList = document.getElementById('sites-list');
                sitesList.classList.toggle('hidden');
            }

            document.getElementById('add-member-btn').addEventListener('click', function() {
                const card = document.getElementById('add-member-card');
                card.classList.toggle('hidden');
            });

            document.getElementById('add-website-button').addEventListener('click', function() {
                var form = document.getElementById('add-website-form');
                form.classList.toggle('hidden');
            });

            document.getElementById('cancel-button').addEventListener('click', function() {
                var form = document.getElementById('add-website-form');
                form.classList.add('hidden');
            });
        </script>



    @endsection --}}





















@extends('layout')

@section('content')
    <div class="w-full bg-white p-6 md:mt-[100px] md:p-6">

        {{-- HEADER --}}
        <div
            class="mb-4 mt-6 flex flex-col items-center justify-between rounded-xl bg-white/90 p-6 shadow-lg backdrop-blur-md lg:flex-row">
            <h1 class="text-3xl font-bold text-gray-800 lg:text-4xl">Team Management Dashboard</h1>

            <div class="mt-4 flex flex-col items-center lg:mt-0 lg:flex-row lg:space-x-6">
                <div class="flex items-center space-x-4">
                    <div class="h-12 w-12 overflow-hidden rounded-full border-2 border-gray-300">
                        <img src="https://i.pravatar.cc/150?img=3" alt="User Avatar" class="h-full w-full object-cover">
                    </div>
                    <div class="text-left">
                        <p class="text-lg font-semibold text-gray-700">
                            Welcome, <span class="text-indigo-600">{{ Auth::user()->name }}</span>!
                        </p>
                        {{-- <p class="text-sm text-gray-500">ID: <span class="font-medium">{{ Auth::user()->id }}</span></p> --}}
                        <p class="text-sm text-gray-500">Email: <span class="font-medium">{{ Auth::user()->email }}</span>
                        </p>
                    </div>
                </div>
                <button
                    class="mt-4 rounded-lg bg-gradient-to-r from-red-600 to-red-800 px-5 py-2 text-white shadow-md transition-all duration-300 hover:scale-105 hover:shadow-lg lg:mt-0">
                    Logout
                </button>
            </div>
        </div>

        {{-- SEARCH / FILTER / ACTION BUTTONS --}}
        <div class="grid gap-4 px-6 pb-5 sm:grid-cols-3 md:grid-cols-4">
            {{-- <input type="search" placeholder="Find Site"
                class="w-full rounded-lg border border-blue-600 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />

            <select name="Sort By"
                class="w-full rounded-lg border border-gray-300 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">Sort by ID</option>
                <option value="">Sort by Name</option>
                <option value="">Sort by Added Date</option>
            </select> --}}

            @auth
                @if (Auth::user()->email === 'parindya@gmail.com')
                    <button id="add-website-button"
                        class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                        + Add Website
                    </button>
                    <button id="add-member-btn"
                        class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                        + Add Members
                    </button>
                @endif
            @endauth
        </div>

        {{-- ADD MEMBER FORM --}}
        <div id="add-member-card"
            class="mx-auto mt-6 hidden w-full max-w-lg rounded-xl border border-gray-200 bg-white p-8 shadow-xl">
            <h1 class="mb-6 text-center text-3xl font-semibold text-gray-800">Add Member</h1>
            <form action="/add-member" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600">Name</label>
                    <input type="text" name="name" placeholder="Type New Member Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" placeholder="Type Email"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Password</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Role</label>
                    <select name="role"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>

                <div class="flex justify-between space-x-4">
                    <button type="button"
                        class="cancel-button w-full rounded-lg bg-gray-300 py-3 text-gray-700 hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 py-3 text-white hover:bg-blue-700">Add</button>
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

        {{-- ADD WEBSITE FORM --}}
        <div id="add-website-form"
            class="mx-auto mt-6 hidden w-full max-w-lg rounded-xl border border-gray-200 bg-white p-8 shadow-xl">
            <h1 class="mb-6 text-center text-3xl font-semibold text-gray-800">Add Website</h1>
            <form action="/add-website" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-600">Website Name</label>
                    <input type="text" name="name" placeholder="Type Website Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <label class="mt-4 block text-sm font-medium text-gray-600">Client</label>
                    <input type="text" name="client" placeholder="Type Client Name"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <label class="mt-4 block text-sm font-medium text-gray-600">URL</label>
                    <input type="text" name="url" placeholder="Type URL here"
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div class="flex justify-between space-x-4">
                    <button type="button"
                        class="cancel-button w-full rounded-lg bg-gray-300 py-3 text-gray-700 hover:bg-gray-400">Cancel</button>
                    <button type="submit"
                        class="w-full rounded-lg bg-blue-600 py-3 text-white hover:bg-blue-700">Add</button>
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

        {{-- MEMBER TOGGLE --}}
        <div class="mt-8 w-full cursor-pointer gap-4 rounded-lg border border-blue-600 bg-white p-3 px-6 text-gray-700 shadow-sm"
            onclick="toggleMembers()">
            Members
        </div>

        {{-- <div id="members-list" class="grid hidden w-3/4 grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (App\Models\User::where('role', 'user')->get() as $user)
                <div
                    class="flex flex-col items-center justify-center rounded-lg border border-gray-900 bg-white p-4 shadow-md hover:shadow-xl">
                    <p class="text-lg font-semibold text-gray-700">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                </div>
            @endforeach
        </div> --}}

        <div id="members-list" class="grid hidden w-3/4 grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-3">
    @foreach (App\Models\User::where('role', 'user')->get() as $user)
        <div class="flex flex-col items-center justify-center rounded-lg border border-gray-900 bg-white p-4 shadow-md hover:shadow-xl">
            <p class="text-lg font-semibold text-gray-700">{{ $user->name }}</p>
            <p class="text-sm text-gray-500">{{ $user->email }}</p>

            <div class="mt-4 flex gap-2">
                <a href="#" class="rounded bg-blue-500 px-3 py-1 text-sm font-medium text-white transition hover:bg-blue-600">
                    Edit Info
                </a>
                <form 
                {{-- action="{{ route('users.destroy', $user->id) }}"  --}}
                method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    {{-- @csrf
                    @method('DELETE') --}}
                    <button type="submit" class="rounded bg-red-500 px-3 py-1 text-sm font-medium text-white transition hover:bg-red-600">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>


        {{-- WEBSITE TOGGLE --}}
        <div class="mt-7 w-full cursor-pointer gap-4 rounded-lg border border-blue-600 bg-white p-3 px-6 text-gray-700 shadow-sm"
            onclick="toggleSites()">
            Websites
        </div>

        <div id="sites-list" class="grid w-full gap-6 px-6 py-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">

            @foreach (App\Models\Website::all() as $website)
                <div class="relative rounded-xl border border-gray-300 bg-white p-6 shadow-lg transition hover:shadow-xl">

                    {{-- Header with Toggle Button --}}
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xl font-semibold text-gray-800">{{ $website->name }}</p>
                            <a href="{{ $website->url }}" class="text-sm text-gray-600">{{ $website->url }}</a>
                        </div>
                        <button onclick="toggleActions({{ $website->id }})"
                            class="text-xl text-gray-600 hover:text-blue-600">
                            ▼
                        </button>
                    </div>

                    {{-- Actions Section (Hidden by Default) --}}
                    <div id="actions-{{ $website->id }}" class="mt-4 hidden space-y-4">

                        {{-- Inline Edit Form --}}
                        <form id="edit-form-{{ $website->id }}" action="{{ route('website.update', $website->id) }}"
                            method="POST" class="space-y-3 border-t border-gray-200 pt-4">
                            @csrf
                            @method('PUT')

                            <input type="text" name="name" value="{{ $website->name }}"
                                class="w-full rounded border bg-gray-100 p-2" placeholder="Website Name">
                            <input type="text" name="client" value="{{ $website->client }}"
                                class="w-full rounded border bg-gray-100 p-2" placeholder="Client">
                            <input type="text" name="url" value="{{ $website->url }}"
                                class="w-full rounded border bg-gray-100 p-2" placeholder="URL">

                            <div class="flex justify-between gap-2">
                                <button type="button" onclick="toggleEditForm({{ $website->id }})"
                                    class="w-full rounded bg-gray-300 py-2 text-gray-700 hover:bg-gray-400">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="w-full rounded bg-green-600 py-2 text-white hover:bg-green-700">
                                    Save
                                </button>
                            </div>
                        </form>

                        {{-- Delete Button --}}
                        <form action="{{ route('website.destroy', $website->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full rounded-md bg-red-500 px-4 py-2 text-sm text-white hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

        </div>

        {{-- JS + STYLES --}}
        <style>
            .team-card:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.getElementById('add-member-btn')?.addEventListener('click', () => {
                    document.getElementById('add-member-card').classList.toggle('hidden');
                });

                document.getElementById('add-website-button')?.addEventListener('click', () => {
                    document.getElementById('add-website-form').classList.toggle('hidden');
                });

                document.querySelectorAll('.cancel-button').forEach(btn => {
                    btn.addEventListener('click', () => {
                        btn.closest('div[id]').classList.add('hidden');
                    });
                });
            });

            function toggleMembers() {
                document.getElementById('members-list').classList.toggle('hidden');
            }

            function toggleSites() {
                document.getElementById('sites-list').classList.toggle('hidden');
            }

            function toggleActions(id) {
                const actionDiv = document.getElementById(`actions-${id}`);
                actionDiv.classList.toggle('hidden');
            }

            function toggleEditForm(id) {
                const form = document.getElementById(`edit-form-${id}`);
                form.classList.toggle('hidden');
            }

            function toggleActions(id) {
                const actions = document.getElementById(`actions-${id}`);
                actions.classList.toggle('hidden');
            }

            function toggleEditForm(id) {
                const form = document.getElementById(`edit-form-${id}`);
                form.classList.toggle('hidden');
            }
        </script>
    </div>
@endsection

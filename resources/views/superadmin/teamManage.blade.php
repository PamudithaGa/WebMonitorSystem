@extends('layout2')

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
                <div class="relative flex h-auto flex-col items-center justify-center rounded-xl border border-gray-300 bg-white p-6 shadow-lg transition duration-300 ease-in-out hover:scale-105 hover:shadow-xl">
                    <p class="text-xl font-semibold text-gray-800">{{ $website->name }}</p>                    
                    <a href="{{ $website->url }}" class="mt-1 text-sm text-gray-600">{{ $website->url }}</a>
                    <div class="my-3 h-[1px] w-full bg-gray-200"></div>
        
                    <div class="flex w-full justify-between">
                        <button class="rounded-md bg-blue-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-600">
                            Edit
                        </button>
                        <form action="{{ route('website.destroy', $website->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="rounded-md bg-red-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-red-600">
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


        {{-- <div class="pt-[10px]">
            <div
                class="w-full gap-4 rounded-lg border border-blue-600 bg-white p-3 px-6 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                Teams
            </div>

            <div class="grid grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (App\Models\Website::all() as $website)
                    <div onclick="showTeamDetails('{{ Str::slug($website->name, '_') }}')" class="team-card">
                        <h2>Team {{ $website->name }}</h2>
                    </div>
                @endforeach
            </div>

            <div id="team-modal" class="fixed inset-0 flex hidden items-center justify-center bg-black bg-opacity-50">
                <div class="w-[90%] max-w-lg rounded-xl bg-white p-6 shadow-xl">
                    <h2 id="team-name" class="text-2xl font-bold text-gray-800"></h2>
                    <p id="team-description" class="mt-2 text-gray-600"></p>

                    <ul id="team-members" class="mt-4 space-y-2 text-gray-700"></ul>

                    <button onclick="closeModal()"
                        class="mt-6 w-full rounded-lg bg-red-600 p-3 font-semibold text-white shadow-md hover:bg-red-700">
                        Close
                    </button>
                </div>
            </div>
        </div> --}}



        {{-- <label for="members">Add Members</label> --}}
        {{-- <select id="members" name="members" multiple
                        class="w-full rounded-lg border border-gray-300 bg-gray-100 p-4 transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500">
                        @foreach (App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select> --}}


        {{-- <div id="addmember" class="mb-6">
                        <div id="memberFields" class="space-y-4">
                            <div class="member-row flex items-center space-x-4">
                                <select name=" member_id[]" class="member-select w-full rounded border px-3 py-2">
                                    <option value="">Select Member</option>
                                    @foreach (App\Models\User::all() as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>

                                <button type="button"
                                    class="add-member inline-flex items-center rounded-md bg-green-500 px-3 py-1.5 text-white hover:bg-green-600">+</button>
                            </div>
                        </div>
                    </div
        </div> --}}

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




        {{-- <div id="" class="">
            <table class="">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\User::all() as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="" class="">
            <table class="">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\User::where('role', 'admin')->get() as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div id="" class="">
            <table class="">
                <thead>
                    <tr>
                        <th>Website Name</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Website::all() as $website)
                        <tr>

                            <td>{{ $website->name }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}

        {{-- <div id="" class="">
            <table class="">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Website Name</th>
                        <th>Owner Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (App\Models\Website::where('name', 'CCL')->get() as $website)
                        <tr>
                            <td>{{ $website->id }}</td>
                            <td>{{ $website->name }}</td>
                            <td>{{ $website->url }}</td>
                            <td>{{ $website->user ? $website->user->name : 'No Owner' }}</td>
                            <td>{{ $website->user ? $website->user->email : 'No Email' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div> --}}


        {{-- <script>
            const teams = {
                @php
                    use Illuminate\Support\Str;
                    $websites = App\Models\Website::all();
                    foreach ($websites as $index => $website) {
                        $key = Str::slug($website->name, '_'); // Convert name to a valid JavaScript key
                        echo "\"{$key}\": {
                            name: \"Team {$website->name}\",
                            description: \"{$website->url}\", 
                            members: [\"" .
                            ($website->user ? $website->user->name : 'No Owner') .
                            "\"]
                        }";
                        if ($index !== $websites->count() - 1) {
                            echo ',';
                        }
                    }
                @endphp
            };

            console.log(teams); // Debugging: Check the output in the console

            function showTeamDetails(teamKey) {
                const team = teams[teamKey];
                if (!team) {
                    alert("Team not found!");
                    return;
                }
                document.getElementById("team-name").innerText = team.name;
                document.getElementById("team-description").innerText = team.description;

                const membersList = document.getElementById("team-members");
                membersList.innerHTML = "";
                team.members.forEach(member => {
                    const li = document.createElement("li");
                    li.textContent = `• ${member}`;
                    membersList.appendChild(li);
                });

                document.getElementById("team-modal").classList.remove("hidden");
            }

            function closeModal() {
                document.getElementById("team-modal").classList.add("hidden");
            }
        </script> --}}

        {{-- 
        <style>
            .team-card {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 220px;
                width: 220px;
                background: white;
                border-radius: 15px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                backdrop-filter: blur(10px);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
            }

            .team-card:hover {
                transform: scale(1.05);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            }
        </style> --}}
    @endsection

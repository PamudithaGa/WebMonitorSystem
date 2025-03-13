{{-- @extends('layout2')

@section('content')
    <div class= "w-full bg-white p-6 md:mt-[100px] md:p-6">
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

        <div class="grid grid-cols-1 gap-4 px-6 pb-5 sm:grid-cols-3">
            <input type="search" placeholder="Find Member"
                class="w-full rounded-lg border border-blue-600 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />

            <select name="Sort By"
                class="w-full rounded-lg border border-gray-300 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">Sort by ID</option>
                <option value="">Sort by Name</option>
            </select>

            <button
                class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                + Add Member
            </button>
        </div>

        <div class="grid gap-4 px-6 pb-5">
            <select name="Sort By"
            class="w-full rounded-lg border border-gray-300 bg-blue-600 p-3 text-white shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
            <option value="" >Admins</option>
            <option value="">Sort by Name</option>
        </select>
        </div>

        

        <div class="grid grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-4">
            <div
                class="flex h-[220px] w-[220px] flex-col items-center justify-center rounded-xl bg-white/90 shadow-lg backdrop-blur-md transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <h2 class="text-lg font-bold text-gray-800">Team CCL</h2>
                <p class="mt-2 text-sm text-gray-500">Innovating the future</p>
            </div>

            <div
                class="flex h-[220px] w-[220px] flex-col items-center justify-center rounded-xl bg-white/90 shadow-lg backdrop-blur-md transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <h2 class="text-lg font-bold text-gray-800">Team OfficeOne</h2>
                <p class="mt-2 text-sm text-gray-500">Efficiency in every step</p>
            </div>

            <div
                class="flex h-[220px] w-[220px] flex-col items-center justify-center rounded-xl bg-white/90 shadow-lg backdrop-blur-md transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <h2 class="text-lg font-bold text-gray-800">Team Matale Alu Wihara</h2>
                <p class="mt-2 text-sm text-gray-500">Preserving heritage</p>
            </div>

            <div
                class="flex h-[220px] w-[220px] flex-col items-center justify-center rounded-xl bg-white/90 shadow-lg backdrop-blur-md transition-all duration-300 hover:scale-105 hover:shadow-xl">
                <h2 class="text-lg font-bold text-gray-800">Team Panagoda</h2>
                <p class="mt-2 text-sm text-gray-500">Preserving heritage</p>
            </div>
        </div>
    </div>
@endsection --}}


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

        <div class="grid grid-cols-1 gap-4 px-6 pb-5 sm:grid-cols-3">
            <input type="search" placeholder="Find Member"
                class="w-full rounded-lg border border-blue-600 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" />

            <select name="Sort By"
                class="w-full rounded-lg border border-gray-300 bg-white p-3 text-gray-700 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200">
                <option value="">Sort by ID</option>
                <option value="">Sort by Name</option>
            </select>

            <button
                class="w-full rounded-lg bg-blue-600 p-3 font-semibold text-white shadow-md transition-all duration-300 hover:bg-blue-700 hover:shadow-lg">
                + Add Member
            </button>
        </div>

        <div class="grid grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-4">
            <div onclick="showTeamDetails('CCL')" class="team-card">
                <h2>Team CCL</h2>
                <p>Innovating the future</p>
            </div>

            <div onclick="showTeamDetails('OfficeOne')" class="team-card">
                <h2>Team OfficeOne</h2>
                <p>Efficiency in every step</p>
            </div>

            <div onclick="showTeamDetails('Matale')" class="team-card">
                <h2>Team Matale Alu Wihara</h2>
                <p>Preserving heritage</p>
            </div>

            <div onclick="showTeamDetails('Panagoda')" class="team-card">
                <h2>Team Panagoda</h2>
                <p>Innovation & Growth</p>
            </div>
        </div>
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
    


    <script>
        const teams = {
            CCL: {
                name: "Team CCL",
                description: "Innovating the future",
                members: ["Alice Johnson", "Bob Smith", "Charlie Brown"]
            },
            OfficeOne: {
                name: "Team OfficeOne",
                description: "Efficiency in every step",
                members: ["David Lee", "Emma Watson", "Franklin Carter"]
            },
            Matale: {
                name: "Team Matale Alu Wihara",
                description: "Preserving heritage",
                members: ["George White", "Hannah Baker", "Isaac Newton"]
            },
            Panagoda: {
                name: "Team Panagoda",
                description: "Innovation & Growth",
                members: ["Jack Daniels", "Kylie Jenner", "Lionel Messi"]
            }
        };

        function showTeamDetails(teamKey) {
            const team = teams[teamKey];
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
    </script>

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
    </style>
@endsection













{{-- @extends('layout2')

@section('content')
<div class="w-full bg-white p-6 md:mt-[100px] md:p-6">
    <div class="mb-4 mt-6 flex flex-col items-center justify-between rounded-xl bg-white/90 p-6 shadow-lg backdrop-blur-md lg:flex-row">
        <h1 class="text-3xl font-extrabold text-gray-800 lg:text-4xl">Team Management Dashboard</h1>
    </div>

    <div class="grid grid-cols-1 gap-6 px-6 py-8 sm:grid-cols-2 lg:grid-cols-4">
        @foreach($teams as $team)
        <div 
            class="flex h-[220px] w-[220px] cursor-pointer flex-col items-center justify-center rounded-xl bg-white/90 shadow-lg backdrop-blur-md transition-all duration-300 hover:scale-105 hover:shadow-xl"
            onclick="showTeamMembers('{{ $team->id }}', '{{ $team->name }}')">
            <h2 class="text-lg font-bold text-gray-800">{{ $team->name }}</h2>
            <p class="mt-2 text-sm text-gray-500">{{ $team->description }}</p>
        </div>
        @endforeach
    </div>

    <div id="team-members-section" class="hidden px-6">
        <h2 id="team-name" class="mb-4 text-2xl font-bold text-gray-800"></h2>
        <table class="w-full border-collapse border border-gray-300 shadow-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="border border-gray-300 p-3">ID</th>
                    <th class="border border-gray-300 p-3">Name</th>
                    <th class="border border-gray-300 p-3">Role</th>
                    <th class="border border-gray-300 p-3">Email</th>
                </tr>
            </thead>
            <tbody id="team-members-body" class="bg-white"></tbody>
        </table>
    </div>
</div>

<script>
    function showTeamMembers(teamId, teamName) {
        const teamData = {
            1: [{ id: 101, name: "Alice Johnson", role: "Lead", email: "alice@example.com" },
                { id: 102, name: "Bob Smith", role: "Developer", email: "bob@example.com" }],
            2: [{ id: 201, name: "Charlie Brown", role: "Designer", email: "charlie@example.com" },
                { id: 202, name: "David Lee", role: "Tester", email: "david@example.com" }],
            3: [{ id: 301, name: "Eva Green", role: "Project Manager", email: "eva@example.com" }],
            4: [{ id: 401, name: "Frank White", role: "Support", email: "frank@example.com" }]
        };

        const members = teamData[teamId] || [];
        let tableBody = document.getElementById("team-members-body");
        let teamNameHeading = document.getElementById("team-name");
        let section = document.getElementById("team-members-section");

        teamNameHeading.textContent = "Team: " + teamName;

        tableBody.innerHTML = "";

        members.forEach(member => {
            let row = `<tr class="border-b">
                <td class="border border-gray-300 p-3">${member.id}</td>
                <td class="border border-gray-300 p-3">${member.name}</td>
                <td class="border border-gray-300 p-3">${member.role}</td>
                <td class="border border-gray-300 p-3">${member.email}</td>
            </tr>`;
            tableBody.innerHTML += row;
        });

        section.classList.remove("hidden");
    }
</script>
@endsection --}}

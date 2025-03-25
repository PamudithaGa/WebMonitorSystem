<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NEXUSMoNITOR' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/myscripts.js') }}" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    },
                },
            },
        };

        function toggleMobileMenu() {
            document.getElementById('sidebar').classList.toggle('hidden');
        }
    </script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <header>
        <nav
            class="fixed z-10 flex h-[80px] w-full items-center justify-between bg-slate-900 px-8 text-white shadow-lg">
            <a href="">
                <img class="h-[110px] w-[260px]" src="{{ asset('img/logo1.png') }}" alt="Logo">
            </a>

            <button class="focus:outline-none md:hidden" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                <i class="fas fa-bars text-2xl text-white"></i>
            </button>

            <input type="search" placeholder="Search Website"
                class="h-12 w-1/2 rounded-full border border-gray-300 px-4 text-black placeholder-gray-500 shadow-md outline-none transition duration-300 focus:border-red-500 focus:ring-2 focus:ring-red-400" />

            <div class="hidden space-x-4 md:flex">
                <a href=""><i class="fas fa-user-tie"></i></a>
            </div>
        </nav>
    </header>

    <div class="flex">
        <aside id="sidebar"
            class="fixed mt-[75px] hidden h-screen w-64 bg-gray-900 shadow-lg transition-all duration-300 ease-in-out md:block">
            <nav class="mt-6">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('adminDash') }}"
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('monitor') }}"
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-check-double mr-3"></i> Monitoring
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file-invoice mr-3"></i> Reports
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-bug mr-3"></i> AI-Visual Checks
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ssl') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-bell mr-3"></i> SSL Alerts
                        </a>
                    </li>
                    <li>
                        <a href={{ route('team') }}
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-users mr-3"></i> Controller
                        </a>
                    </li>
                </ul>
            </nav>
            <h1 class="mb-full text-gray-300"><i class="far fa-copyright"></i>Powerd By All In One Holdings</h1>
        </aside>

        <main class="ml-[20%] p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>

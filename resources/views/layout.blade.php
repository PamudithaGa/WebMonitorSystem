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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- FullCalendar CSS -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />

    <!-- FullCalendar JS -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>


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

            <div class="hidden space-x-4 md:flex">
                <a href=""><i class="fas fa-user-tie"></i></a>
            </div>
        </nav>
    </header>

    <div class="flex">
        <aside id="sidebar"
            class="fixed mt-[75px] flex hidden h-screen w-64 flex-col justify-between bg-gray-900 shadow-lg transition-all duration-300 ease-in-out md:block">

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
                        <a href="{{ route('report.index') }}"
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file-invoice mr-3"></i> Reports
                        </a>
                    </li>
                    {{-- <li>
                        <a href="{{route('visualChecks')}}"
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-bug mr-3"></i> AI- Based Error Checks
                        </a>
                    </li> --}}
                    <li>
                        <a href="{{ route('ssl') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-bell mr-3"></i> SSL Alerts
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('seo.dashboard') }}"
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-chart-line mr-3"></i> SEO Checking
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


            <!-- Footer fixed at bottom -->
            <div class="p-4">
                <h1 class="text-center text-xs text-gray-300">
                    <i class="far fa-copyright"></i> Powered By All In One Holdings
                </h1>
            </div>
        </aside>


        <main class="ml-[20%] w-full p-6">

            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')

</body>

</html>

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'NEXUSMoNITOR' }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/myscripts.js') }}" defer></script>
    <Script src="https://cdn.tailwindcss.com"></Script>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@400;600&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@400;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    fontFamily: {
                        'just-another-hand': ['"Just Another Hand"', 'cursive'],
                        'julius-sans-one': ['"Julius Sans One"', 'sans-serif'],
                        'righteous-regular': ['"Righteous", sans-serif'],
                        'inconsolata': ['"Inconsolata"', 'monospace'],
                        'josefin-slab': ['"Josefin Slab"', 'serif'],
                        'righteous': ['"Righteous"', 'sans-serif'],
                        'k2d': ['"K2D"', 'sans-serif'],
                        'lateef': ['"Lateef"', 'serif'],
                    },
                },
            },
        };
    </script>
</head>

<body class="m-0">
    <header class="m-0">
        <nav
            class="fixed z-10 flex h-[80px] w-full items-center justify-between bg-slate-900 px-8 text-white shadow-lg">
            <a href="">
                <img class="h-[70px] w-[100px]" src="{{ asset('img/pp-01-removebg.png') }}" alt="Logo">
            </a>

            <button class="focus:outline-none md:hidden" onclick="toggleMobileMenu()" aria-label="Toggle Menu">
                <i class="fas fa-bars text-2xl text-white"></i>
            </button>

            <input type="search" placeholder="Search Website"
                class="h-12 w-1/2 rounded-full border border-gray-300 px-4 text-black placeholder-gray-500 shadow-md outline-none transition duration-300 focus:border-red-500 focus:ring-2 focus:ring-red-400" />


            <div class="hidden space-x-4 md:flex">
                <a href="">
                    <i class="fas fa-user-tie"></i>
                </a>
            </div>
        </nav>
    </header>

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">
        <div class="flex">
            <div
                class="fixed mt-[75px] hidden h-screen w-64 bg-gray-900 shadow-lg transition-all duration-300 ease-in-out md:block"id="sidebar">
                <nav class="mt-6">
                    <ul class="space-y-2">
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-check-double mr-3"></i>Monitoring
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-file-invoice -alt mr-3"></i> Reportss

                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-bug mr-3"></i> AI-Visual Checks
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-bell mr-3" style="color: #ffffff; "></i>SSL Alerts</a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                                <i class="fas fa-bell mr-3"></i> Team Members
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="flex items-center rounded-md px-6 py-3 text-red-400 transition hover:bg-red-600 hover:text-white">
                                <i class="fas fa-sign-out-alt mr-3"></i> Logout
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </body>



    <main>
        @yield('content')
    </main>
 --}}

{{-- <footer class="bg-black py-10">
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between space-y-8 px-8 md:flex-row md:space-y-0">
            <div class="text-center md:text-left">
                <img class="w-[200px]" src="{{ asset('img/logoImg-removebg-preview.png') }}" alt="Pearl Princess Events Logo">
            </div>
    
            <div class="flex flex-col items-center justify-center text-center md:items-start md:text-left">
                <p class="text-white">To get details about special events & offers</p>
                <input 
                    class="mt-2 w-full border-b-2 border-white bg-transparent p-2 text-white placeholder-gray-400 focus:outline-none md:w-auto" 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Type your email here">
            </div>
    
            <div class="flex flex-col items-center space-y-4 text-center md:items-start md:text-left">
                <h2 class="text-lg text-white">Contact</h2>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com" target="_blank" rel="noopener noreferrer">
                        <img class="h-[50px] w-[50px] hover:opacity-80" src="{{ asset('img/Facebook_Logo_2023.png') }}" alt="Facebook">
                    </a>
                    <a href="mailto:info@pearlprincess.com">
                        <img class="h-[50px] w-[50px] hover:opacity-80" src="{{ asset('img/gmail-icon-free-png.png') }}" alt="Gmail">
                    </a>
                    <a href="tel:+123456789">
                        <img class="h-[55px] w-[55px] hover:opacity-80" src="{{ asset('img/phone.png') }}" alt="Phone">
                    </a>
                </div>
            </div>
        </div>
    
        <div class="mt-8 text-center">
            <h2 class="text-sm text-white">&copy; 2024 incess Events. All rights reserved.</h2>
        </div>
    </footer> --}}
{{-- <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>

</html> --}}







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
                <img class="h-[70px] w-[100px]" src="{{ asset('img/pp-01-removebg.png') }}" alt="Logo">
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
                        <a href=""
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <a href=""
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
                        <a href=""
                            class="flex items-center px-6 py-3 text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-bell mr-3"></i> SSL Alerts
                        </a>
                    </li>
                    <li>
                        <a href={{ route('team') }}
                            class="flex items-center rounded-md px-6 py-3 text-gray-300 transition hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-users mr-3"></i> Team Members
                        </a>
                    </li>
                    <li>
                        <a href=""
                            class="flex items-center rounded-md px-6 py-3 text-red-400 transition hover:bg-red-600 hover:text-white">
                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <main class="ml-[20%] p-6">
            @yield('content')
        </main>
    </div>
</body>

</html>

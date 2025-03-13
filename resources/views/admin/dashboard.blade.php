@extends('layout')
@section('content')

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">
        <div class="flex">
            <div
                class="fixed mt-[75px] hidden h-screen w-64 bg-gray-900 shadow-lg transition-all duration-300 ease-in-out md:block"id="sidebar">
                <div class="mt-10 flex flex-col items-center">
                    <img class="h-16 w-16 rounded-full border-2 border-gray-500" src="{{ asset('..\img\admin.png') }}"
                        alt="Admin Profile Picture">
                    <h2 class="mt-2 text-lg font-semibold text-white">Admin</h2>
                </div>

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
        @endsection

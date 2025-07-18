@extends('layout')
@section('content')

    <body class="bg-gray-100 font-sans leading-normal tracking-normal">

        <div class="mt-[10px] flex min-h-screen items-center justify-center bg-gray-100">
            <div class="animate-fade-in max-w-md rounded-2xl bg-white p-10 text-center shadow-lg">
                <h1 class="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">
                    🚧 In Development Phase
                </h1>
                <p class="text-base text-gray-600">
                    We're building something awesome! Check back soon for updates.
                </p>
                <div class="mt-6 flex justify-center">
                    <div class="h-1 w-24 rounded-full bg-gradient-to-r from-red-400 via-yellow-400 to-green-400"></div>
                </div>
            </div>
        </div>

        <!-- Add this animation in your Tailwind config or CSS -->
        <style>
            @keyframes fade-in {
                0% {
                    opacity: 0;
                    transform: translateY(20px);
                }

                100% {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in {
                animation: fade-in 1s ease-out forwards;
            }
        </style>

    </body>
@endsection

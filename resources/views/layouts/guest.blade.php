<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Login') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-900 text-gray-100 h-dvh overflow-hidden">
    <div class="h-dvh flex items-center justify-center bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <!-- Background Decoration -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute top-20 right-20 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob">
            </div>
            <div
                class="absolute bottom-20 left-20 w-72 h-72 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000">
            </div>
        </div>

        <!-- Logo -->
        <div class="absolute top-8 left-8 z-50">
            <a href="/" class="inline-flex items-center">
                <x-application-logo class="w-10 h-10 fill-current text-indigo-400" />
            </a>
        </div>

        <!-- Main Content: Split Layout -->
        <div class="w-full h-screen flex">
            <!-- Left Side: Background Image -->
            <div class="hidden lg:flex w-[90%] items-center justify-center ">
                <img src="{{ asset('bg-home-page.png') }}" alt="Background" class="w-full h-full object-cover">
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-full lg:w-1/2 h-full flex items-center justify-center">
                <div class="w-full ">
                    <div class="w-full h-screen bg-black border border-gray-700 rounded-2xl shadow-2xl">
                        <div class="h-1 bg-gradient-to-r from-indigo-600 to-purple-600"></div>
                        <div class="p-8">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes blob {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            33% {
                transform: translate(30px, -50px) scale(1.1);
            }

            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }
    </style>
</body>

</html>

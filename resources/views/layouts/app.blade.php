<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-[#121212] border-b border-gray-800 shadow-lg shadow-black/20">
                <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="relative min-h-screen ">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="relative z-10">

                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>

<style>
    main {
        background-image: url('{{ asset('bg-large.jpg') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        backdrop-filter: blur(4px);
    }
</style>

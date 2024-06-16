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
    @livewire('wire-elements-modal')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<style>
    .text-gray-900 {
        color: #1a202c;
    }

    .bg-gray-100 {
        background-color: #f7fafc;
    }

    .bg-white {
        background-color: #fff;
    }

    .bg-gray-800 {
        background-color: #2d3748;
    }

    .text-black {
        color: #000000;
    }

    .hover:bg-gray-700 {
        background-color: #4a5568;
    }

    .dark:text-gray-800 {
        color: #2d3748;
    }

</style>
<body class="font-sans antialiased text-white ">
    <div
        class="flex flex-col items-center pt-6 min-h-screen bg-gray-100 sm:justify-center sm:pt-0 bg-[linear-gradient(180deg,_#000000_38.19%,_#6F42C1_100%)]">
        <div>
            <a href="/" wire:navigate>
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a>
        </div>

        <div class="overflow-hidden py-4 px-6 mt-6 w-full bg-gray-800 shadow-md sm:max-w-md sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>

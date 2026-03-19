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
    @vite(['resources/css/app.css', 'resources/css/sidebar.css', 'resources/css/topbar.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="flex min-h-screen bg-biblo-oat">
        <x-sidebar active="home" />

        <div id="sidebarOverlay" class="fixed inset-0 z-[90] bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden"></div>

        <main class="flex-1 p-6 md:p-10">
            <div class="flex-1">
                <x-topbar :title="$title ?? 'Explore'" />

                <main class="p-8 md:p-10 lg:p-12 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </main>
    </div>
    {{-- <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div> --}}
</body>

</html>
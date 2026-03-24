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

        <div id="sidebarOverlay"
            class="fixed inset-0 z-[90] bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden">
        </div>

        <main class="flex-1 p-4 sm:p-6 md:p-8 lg:p-10 transition-all duration-300">
            <div class="flex-1">
                <x-topbar :title="$title ?? 'Explore'" />

                <main class="p-4 sm:p-6 md:p-8 lg:p-12 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </main>
    </div>
</body>

</html>
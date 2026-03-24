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

<body class="font-sans antialiased" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen bg-biblo-oat">

        <x-sidebar active="home" ::class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" />

        <div id="sidebarOverlay" x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-[90] bg-black/40 transition-opacity duration-300 lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        </div>

        <main class="flex-1 p-6 md:p-10 transition-all duration-300">
            <div class="flex-1">
                <x-topbar :title="$title ?? 'Explore'" />

                <main class="p-8 md:p-10 lg:p-12 overflow-y-auto">
                    {{ $slot }}
                </main>
            </div>
        </main>
    </div>
</body>

</html>
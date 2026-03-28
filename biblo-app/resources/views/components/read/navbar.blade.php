@props(['title', 'currentPage', 'totalPages', 'backUrl' => null, 'petImage' => null])

<nav class="fixed top-0 inset-x-0 z-50 
    bg-[#FDFBF8]/80 dark:bg-biblo-dark-surface/80 
    backdrop-blur-md 
    border-b border-biblo-greige/20 dark:border-white/10
    transition-colors duration-300">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 sm:h-20 flex items-center justify-between">

        <!-- LEFT SIDE -->
        <div class="flex items-center gap-3 sm:gap-4">

            <!-- Back button -->
            <a href="{{ $backUrl ?? route('explore') }}" id="back-btn"
                class="text-biblo-charcoal/40 dark:text-biblo-dark-text/50 
                       hover:text-biblo-charcoal dark:hover:text-white 
                       transition-colors flex items-center">

                <!-- BIG arrow (mobile) -->
                <span class="text-2xl font-black sm:hidden">
                    ←
                </span>

                <!-- Arrow + text (desktop) -->
                <span class="hidden sm:block text-[11px] font-extrabold uppercase tracking-widest 
                    text-biblo-charcoal dark:text-biblo-dark-text">
                    ← Kembali
                </span>
            </a>

            <!-- Divider (desktop only) -->
            <div class="hidden sm:block h-4 w-[1px] bg-biblo-greige/40 dark:bg-white/20"></div>

            <!-- Title-->
            <h1 class="sm:block text-sm font-extrabold tracking-tight 
                text-biblo-charcoal dark:text-biblo-dark-text">
                {{ $title }}
            </h1>
        </div>

        <!-- RIGHT SIDE -->
        <div class="flex items-center gap-4 sm:gap-6">

            <!-- Page info -->
            <span class="text-[11px] sm:text-[11px] font-bold uppercase tracking-widest 
                text-biblo-charcoal/40 dark:text-biblo-dark-text/50">

                <!-- Hide "Halaman" on mobile -->
                <span class="hidden sm:inline">Halaman</span>

                <span id="reader-current-page"
                    class="text-biblo-charcoal dark:text-white">
                    {{ $currentPage }}
                </span>
                / {{ $totalPages }}
            </span>

            <!-- Settings / pet -->
            <button class="hover:rotate-45 transition-transform duration-500">
                <img src="{{ $petImage ?? asset('images/boo-pet.webp') }}"
                    class="h-6 w-6 object-contain opacity-90 dark:opacity-80" 
                    alt="Pengaturan">
            </button>
        </div>

    </div>
</nav>
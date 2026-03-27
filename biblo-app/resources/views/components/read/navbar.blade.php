@props(['title', 'currentPage', 'totalPages', 'backUrl' => null, 'petImage' => null])

<nav class="fixed top-0 inset-x-0 z-50 
    bg-[#FDFBF8]/80 theme-dark:bg-biblo-dark-surface/80 
    backdrop-blur-md 
    border-b border-biblo-greige/20 theme-dark:border-white/10
    transition-colors duration-300">

    <div class="max-w-4xl mx-auto px-6 h-20 flex items-center justify-between">

        <div class="flex items-center gap-4">
            <a href="{{ $backUrl ?? route('explore') }}" id="back-btn"
                class="text-biblo-charcoal/40 theme-dark:text-biblo-dark-text/50 
                       hover:text-biblo-charcoal theme-dark:hover:text-white 
                       transition-colors">

                <span class="text-[11px] font-extrabold uppercase tracking-widest 
                    text-biblo-charcoal theme-dark:text-biblo-dark-text">
                    ← Kembali
                </span>
            </a>

            <div class="h-4 w-[1px] bg-biblo-greige/40 theme-dark:bg-white/20"></div>

            <h1 class="text-sm font-extrabold tracking-tight 
                text-biblo-charcoal theme-dark:text-biblo-dark-text">
                {{ $title }}
            </h1>
        </div>

        <div class="flex items-center gap-6">
            <span class="text-[11px] font-bold uppercase tracking-widest 
                text-biblo-charcoal/40 theme-dark:text-biblo-dark-text/50">

                Halaman 
                <span id="reader-current-page" 
                    class="text-biblo-charcoal theme-dark:text-white">
                    {{ $currentPage }}
                </span> 
                / {{ $totalPages }}
            </span>

            <button class="hover:rotate-45 transition-transform duration-500">
                <img src="{{ $petImage ?? asset('images/boo-pet.webp') }}" 
                     class="h-6 w-6 object-contain opacity-90 theme-dark:opacity-80" 
                     alt="Pengaturan">
            </button>
        </div>

    </div>
</nav>
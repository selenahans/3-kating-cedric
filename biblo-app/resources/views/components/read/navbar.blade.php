@props(['title', 'currentPage', 'totalPages', 'backUrl' => null])

<nav class="fixed top-0 inset-x-0 z-50 bg-[#FDFBF8]/80 backdrop-blur-md border-b border-biblo-greige/20">
    <div class="max-w-4xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-4">
            {{-- <a href="{{ route('explore') }}"
                class="text-biblo-charcoal/40 hover:text-biblo-charcoal transition-colors">
                <span class="text-[11px] font-extrabold uppercase tracking-widest text-biblo-charcoal">← Back</span>
            </a> --}}
            {{-- Di dalam navbar.blade.php --}}
            <a href="{{ $backUrl ?? route('explore') }}" id="back-btn"
                class="text-biblo-charcoal/40 hover:text-biblo-charcoal transition-colors">
                <span class="text-[11px] font-extrabold uppercase tracking-widest text-biblo-charcoal">← Back</span>
            </a>
            <div class="h-4 w-[1px] bg-biblo-greige/40"></div>
            <h1 class="text-sm font-extrabold tracking-tight">{{ $title }}</h1>
        </div>

        <div class="flex items-center gap-6">
            <span class="text-[11px] font-bold text-biblo-charcoal/40 uppercase tracking-widest">
                Page <span id="reader-current-page" class="text-biblo-charcoal">{{ $currentPage }}</span> / {{ $totalPages }}
            </span>
            <button class="hover:rotate-45 transition-transform duration-500">
                <img src="{{ asset('images/boo-pet.webp') }}" class="h-6 w-6 object-contain" alt="Settings">
            </button>
        </div>
    </div>
</nav>
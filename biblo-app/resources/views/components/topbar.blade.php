<header class="biblo-topbar">
    <button type="button" class="icon-btn" onclick="toggleSidebar()" aria-label="Toggle sidebar">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="3" y1="12" x2="21" y2="12"></line>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <line x1="3" y1="18" x2="21" y2="18"></line>
        </svg>
    </button>
    <form class="search-wrapper" method="GET" action="{{ route('search.global') }}">
        <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-[#CFC8BE]" aria-label="Cari">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
        </button>
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari buku, kategori, atau catatan..." class="search-input">
    </form>

    <div class="md:hidden">
        <img src="{{ asset('images/logo/biblo.webp') }}" class="h-6 w-auto" alt="Logo">
    </div>

    <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ url('/notification') }}" class="icon-btn group inline-flex" aria-label="Buka notifikasi">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
            </svg>
            <span class="notification-dot"></span>
        </a>

        <div class="user-nav-profile">
            <div class="text-right hidden sm:block">
                <p class="text-xs font-bold text-[#3F453F] leading-none">{{ Auth::user()->name ?? 'Reader' }}</p>
                <p class="text-[9px] font-black text-[#7E8F7A] uppercase tracking-tighter mt-1">Pet: {{ $currentPetName ?? 'boo' }}</p>
            </div>
            <div
                class="w-9 h-9 rounded-xl bg-[#F2EFEA] border border-[#CFC8BE]/20 flex items-center justify-center text-sm">
                <img src="{{ $currentPetImage ?? asset('images/boo-pet.webp') }}" alt="Pet Equipped" class="w-6 h-6 object-contain">
            </div>
        </div>


    </div>
</header>
<aside class="biblo-sidebar">
    <div class="space-y-12">
        <div class="sidebar-brand px-4 flex items-center justify-between gap-3">
            <a href="/" class="sidebar-brand-logo">
                <img src="{{ asset('images/logo/biblo.webp') }}" class="h-8 w-auto" alt="Biblo Logo">
            </a>
            <button type="button" class="lg:hidden p-2 rounded-xl text-[#3F453F]/60 hover:text-[#3F453F] hover:bg-[#F2EFEA] transition-colors" onclick="toggleSidebar(false)" aria-label="Tutup sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <nav class="sidebar-nav-group">           
            <a href="/dashboard" class="sidebar-link sidebar-link-active">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                </div>
                <span class="sidebar-text text-sm font-bold">Home</span>
            </a>

            <a href="/explore" class="sidebar-link sidebar-link-inactive">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                </div>
                <span class="sidebar-text text-sm font-bold">Explore</span>
            </a>

            <a href="/library" class="sidebar-link sidebar-link-inactive">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                </div>
                <span class="sidebar-text text-sm font-bold">My Library</span>
            </a>

            <a href="/notes" class="sidebar-link sidebar-link-inactive">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </div>
                <span class="sidebar-text text-sm font-bold">Notes</span>
            </a>

            <a href="/pet" class="sidebar-link sidebar-link-inactive">
                <div class="sidebar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                </div>
                <span class="sidebar-text text-sm font-bold">My Pet</span>
            </a>
        </nav>
    </div>

    <div class="space-y-6">
        <div class="h-[1px] bg-[#CFC8BE]/20 mx-2"></div>
        
        <div class="sidebar-user-card">
            <div class="user-avatar">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="sidebar-user-info flex-1 overflow-hidden">
                <p class="text-sm font-bold text-[#3F453F] truncate">{{ Auth::user()->name ?? 'Reader' }}</p>
                <p class="text-[10px] font-bold text-[#7E8F7A] uppercase tracking-tighter">Gold Reader</p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout group">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                <span class="sidebar-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<div class="sidebar-spacer"></div>
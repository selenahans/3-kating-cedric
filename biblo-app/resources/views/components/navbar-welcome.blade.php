<nav id="main-navbar" class="fixed w-full z-[100] transition-all duration-300 py-6 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2 select-none cursor-pointer">
            <a href="/">
                <img src="{{ asset('images/logo/biblo.webp') }}" id="nav-logo" alt="Biblo Logo" 
                     class="h-8 md:h-10 w-auto transition-all duration-300">
            </a>
        </div>

        <div class="hidden md:flex items-center gap-10">
            <div class="flex gap-8 items-center text-sm font-bold text-biblo-greige" id="nav-links">
                <a href="#features" class="hover:text-biblo-sage transition-colors">Fitur</a>
                <a href="#gamifikasi" class="hover:text-biblo-sage transition-colors">Sistem Pet</a>
                <a href="#faq" class="hover:text-biblo-sage transition-colors">FAQ</a>
            </div>
            <div class="h-5 w-[1px] bg-biblo-greige/20"></div>
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-biblo-greige hover:text-white transition-colors" id="nav-login">Masuk</a>
                <button class="bg-biblo-moss text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-biblo-charcoal transition-all hover:shadow-lg shadow-biblo-moss/20">
                    Mulai Membaca
                </button>
            </div>
        </div>

        <button class="md:hidden text-white p-2" id="mobile-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden absolute top-full left-0 w-full bg-white shadow-xl p-6 flex flex-col gap-4 text-center md:hidden border-t border-biblo-oat">
        <a href="#features" class="font-bold py-2">Fitur</a>
        <a href="#gamifikasi" class="font-bold py-2">Sistem Pet</a>
        <a href="#faq" class="font-bold py-2">FAQ</a>
        <hr>
        <button class="bg-biblo-charcoal text-white py-4 rounded-2xl font-bold">Mulai Membaca</button>
    </div>
</nav>
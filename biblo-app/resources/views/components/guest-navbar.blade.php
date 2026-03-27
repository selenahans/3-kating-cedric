<nav id="main-navbar" class="fixed w-full z-[100] transition-all duration-500 py-6 px-6 flex justify-center">
    <div id="navbar-container" class="w-full max-w-7xl transition-all duration-500 rounded-[32px] px-8 py-4 flex justify-between items-center bg-transparent">
        
        <div class="flex items-center gap-2 select-none">
            <a href="/" class="group flex items-center gap-2">
                <img src="{{ asset('images/logo/biblo.webp') }}" id="nav-logo-img" alt="Biblo Logo" 
                     class="h-8 md:h-10 w-auto transition-all duration-300 group-hover:scale-105">
                
            </a>
        </div>

        <div class="hidden md:flex items-center gap-10">
            <div class="flex gap-8 items-center text-[11px] font-black uppercase tracking-[0.2em] text-biblo-greige transition-colors duration-300" id="nav-links">
                <a href="#features" class="hover:text-biblo-sage transition-colors">Fitur</a>
                <a href="#gamifikasi" class="hover:text-biblo-sage transition-colors">Sistem Pet</a>
                <a href="#faq" class="hover:text-biblo-sage transition-colors">FAQ</a>
            </div>
            
            <div class="h-5 w-[1px] bg-biblo-greige/20"></div>
            
            <div class="flex items-center gap-8">
                <a href="{{ route('login') }}" class="text-[11px] font-black uppercase tracking-[0.2em] text-biblo-greige hover:text-white transition-colors duration-300" id="nav-login">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bg-biblo-moss text-white px-7 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-biblo-charcoal hover:-translate-y-1 transition-all shadow-xl shadow-biblo-moss/20">
                    Mulai Membaca
                </a>
            </div>
        </div>

        <button class="md:hidden text-white p-2" id="mobile-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
        </button>
    </div>

    <div id="mobile-menu" class="hidden absolute top-full left-6 right-6 bg-white shadow-2xl p-8 flex flex-col gap-6 text-center md:hidden border border-biblo-oat mt-4 rounded-[32px]">
        <a href="#features" class="font-black text-[11px] uppercase tracking-widest py-2">Fitur</a>
        <a href="#gamifikasi" class="font-black text-[11px] uppercase tracking-widest py-2">Sistem Pet</a>
        <a href="#faq" class="font-black text-[11px] uppercase tracking-widest py-2">FAQ</a>
        <hr>
        
        <a href="{{ route('login') }}" class="bg-biblo-charcoal text-white py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest">Masuk</a>
        <a href="{{ route('register') }}" class="bg-biblo-charcoal text-white py-4 rounded-2xl font-black text-[11px] uppercase tracking-widest">Mulai Membaca</a>
    </div>
</nav>

<script>
    const navbar = document.getElementById('main-navbar');
    const container = document.getElementById('navbar-container');
    const logoText = document.getElementById('logo-text');
    const navLinks = document.getElementById('nav-links');
    const navLogin = document.getElementById('nav-login');
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 80) {
            container.classList.add('navbar-glass', 'shadow-2xl', 'shadow-biblo-charcoal/5');
            navbar.classList.replace('py-6', 'py-4');
            logoText.classList.replace('text-white', 'text-biblo-charcoal');
            navLinks.classList.replace('text-biblo-greige', 'text-biblo-charcoal/60');
            navLogin.classList.replace('text-biblo-greige', 'text-biblo-charcoal/80');
            mobileToggle.classList.replace('text-white', 'text-biblo-charcoal');
        } else {
            container.classList.remove('navbar-glass', 'shadow-2xl', 'shadow-biblo-charcoal/5');
            navbar.classList.replace('py-4', 'py-6');
            logoText.classList.replace('text-biblo-charcoal', 'text-white');
            navLinks.classList.replace('text-biblo-charcoal/60', 'text-biblo-greige');
            navLogin.classList.replace('text-biblo-charcoal/80', 'text-biblo-greige');
            mobileToggle.classList.replace('text-biblo-charcoal', 'text-white');
        }
    });

    mobileToggle.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));
</script>
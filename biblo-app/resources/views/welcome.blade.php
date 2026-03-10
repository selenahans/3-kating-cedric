<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblo - Sahabat Membacamu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'biblo-sage': '#9FAF9A',
                        'biblo-greige': '#CFC8BE',
                        'biblo-oat': '#F2EFEA',
                        'biblo-charcoal': '#3F453F',
                        'biblo-moss': '#7E8F7A',
                        'biblo-clay': '#B09D85',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .organic-shape { border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%; }
        .navbar-glass {
            background: rgba(242, 239, 234, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(159, 175, 154, 0.2);
        }
    </style>
</head>
<body class="bg-biblo-oat text-biblo-charcoal">

    <nav id="main-navbar" class="fixed w-full z-[100] transition-all duration-300 py-6 px-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center gap-2 select-none cursor-pointer">
                <div class="flex items-center text-2xl tracking-tighter">
                    <span class="font-extrabold text-biblo-moss" id="logo-bib">BIB</span>
                    <span class="font-light text-white transition-colors duration-300" id="logo-lo">LO.</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-10">
                <div class="flex gap-8 items-center text-sm font-bold text-biblo-greige" id="nav-links">
                    <a href="#features" class="hover:text-biblo-sage transition-colors">Fitur</a>
                    <a href="#gamifikasi" class="hover:text-biblo-sage transition-colors">Sistem Pet</a>
                    <a href="#faq" class="hover:text-biblo-sage transition-colors">FAQ</a>
                </div>
                <div class="h-5 w-[1px] bg-biblo-greige/20"></div>
                <div class="flex items-center gap-6">
                    <a href="#" class="text-sm font-bold text-biblo-greige hover:text-white transition-colors" id="nav-login">Masuk</a>
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

    <header class="bg-biblo-charcoal rounded-b-[60px] pt-40 pb-32 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 pointer-events-none grid grid-cols-6 gap-10 p-10">
            <span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span>
            <span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="inline-block py-2 px-4 bg-biblo-moss/20 text-biblo-sage rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                ✨ Partner Literasi Digital No. 1
            </span>
            <h1 class="text-white text-5xl md:text-7xl font-extrabold mb-8 leading-[1.1]">
                Membaca Jadi <br> <span class="text-biblo-sage">Lebih Hidup.</span>
            </h1>
            <p class="text-biblo-greige/80 text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed">
                Tumbuhkan kebiasaan membaca bersama pet digitalmu. Setiap halaman yang kamu selesaikan adalah nutrisi untuk pertumbuhannya.
            </p>
            
            <div class="relative inline-block group">
                <div class="w-64 h-64 md:w-80 md:h-80 bg-biblo-moss/20 organic-shape absolute -top-6 -left-6 animate-pulse transition-transform group-hover:scale-110"></div>
                <div class="relative bg-biblo-greige w-64 h-64 md:w-80 md:h-80 organic-shape flex items-center justify-center text-8xl shadow-2xl transform transition-transform group-hover:rotate-6">
                    🦉
                </div>
            </div>
        </div>
    </header>

    <section id="features" class="max-w-6xl mx-auto px-6 -mt-16 relative z-20">
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 hover:translate-y-[-5px] transition-transform">
                <div class="w-14 h-14 bg-biblo-sage/10 rounded-2xl flex items-center justify-center text-2xl mb-8">📖</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Perpustakaan Luas</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Akses ribuan buku digital dari berbagai genre untuk menemani waktu luangmu kapan saja.</p>
            </div>
            <div class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 md:translate-y-12 hover:translate-y-[43px] transition-transform">
                <div class="w-14 h-14 bg-biblo-clay/10 rounded-2xl flex items-center justify-center text-2xl mb-8">🐾</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Pet Interaktif</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Selesaikan target harian untuk memberi makan dan berevolusi bersama teman digitalmu.</p>
            </div>
            <div class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 hover:translate-y-[-5px] transition-transform">
                <div class="w-14 h-14 bg-biblo-moss/10 rounded-2xl flex items-center justify-center text-2xl mb-8">✨</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Smart Highlight</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Simpan poin penting dan buat catatan pribadi secara otomatis yang tersinkronisasi.</p>
            </div>
        </div>
    </section>

    <section id="gamifikasi" class="bg-biblo-sage rounded-[60px] mt-40 py-24 px-6 mx-4 relative overflow-hidden">
        <div class="max-w-5xl mx-auto text-center text-white relative z-10">
            <h2 class="text-4xl md:text-5xl font-extrabold mb-16 leading-tight">Bagaimana Biblo Membantumu?</h2>
            
            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[40px] border border-white/20">
                    <span class="text-4xl block mb-6">🔍</span>
                    <h4 class="font-extrabold text-xl mb-3">01. Pilih Buku</h4>
                    <p class="text-sm text-white/80">Temukan bacaan favoritmu di katalog kurasi kami yang luas.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[40px] border border-white/20">
                    <span class="text-4xl block mb-6">✍️</span>
                    <h4 class="font-extrabold text-xl mb-3">02. Baca & Tandai</h4>
                    <p class="text-sm text-white/80">Gunakan fitur cerdas untuk menangkap ide-ide brilian di setiap bab.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[40px] border border-white/20">
                    <span class="text-4xl block mb-6">📈</span>
                    <h4 class="font-extrabold text-xl mb-3">03. Rawat Pet</h4>
                    <p class="text-sm text-white/80">Lihat progressmu mewujud dalam evolusi pet yang unik dan keren!</p>
                </div>
            </div>

            <button class="mt-20 bg-biblo-charcoal text-white px-12 py-5 rounded-2xl font-bold shadow-2xl hover:bg-black transition-all hover:scale-105">
                Mulai Perjalananmu Sekarang
            </button>
        </div>
    </section>

    <section id="faq" class="py-32 px-6 max-w-4xl mx-auto">
        <div class="text-center mb-20">
            <h2 class="text-4xl md:text-5xl font-extrabold text-biblo-charcoal mb-6">Sering Ditanyakan</h2>
            <p class="text-biblo-charcoal/50 font-medium">Masih bingung? Kami punya jawabannya.</p>
        </div>

        <div class="space-y-4">
            <details class="group bg-white rounded-[32px] border border-biblo-greige/20 shadow-sm overflow-hidden transition-all">
                <summary class="flex justify-between items-center p-8 cursor-pointer list-none">
                    <span class="text-lg font-bold">Apa itu sebenarnya BIBLO?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <div class="px-8 pb-8 text-biblo-charcoal/60 leading-relaxed">
                    BIBLO adalah ekosistem membaca digital yang menggabungkan pembaca buku (e-reader) dengan elemen game (gamifikasi) untuk membangun kebiasaan literasi yang konsisten.
                </div>
            </details>

            <details class="group bg-white rounded-[32px] border border-biblo-greige/20 shadow-sm overflow-hidden transition-all">
                <summary class="flex justify-between items-center p-8 cursor-pointer list-none">
                    <span class="text-lg font-bold">Apakah Pet saya bisa mati?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24"><path d="M6 9l6 6 6-6"></path></svg>
                    </span>
                </summary>
                <div class="px-8 pb-8 text-biblo-charcoal/60 leading-relaxed">
                    Tenang saja! Pet tidak akan mati, namun mereka akan menjadi lemas dan tidak berkembang jika kamu tidak membaca dalam waktu lama. Membaca kembali akan mengembalikan energi mereka.
                </div>
            </details>
        </div>
    </section>

    <footer class="bg-white border-t border-biblo-greige/20 pt-24 pb-12 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start gap-16 pb-20">
                <div class="max-w-xs">
                    <div class="flex items-center text-3xl tracking-tighter mb-6">
                        <span class="font-extrabold text-biblo-moss">BIB</span>
                        <span class="font-light text-biblo-charcoal">LO.</span>
                    </div>
                    <p class="text-biblo-charcoal/50 leading-relaxed mb-8">
                        Membangun masa depan lewat lembaran buku dengan cara yang lebih modern dan adiktif (dalam cara yang baik!).
                    </p>
                </div>

                <div class="grid grid-cols-2 lg:grid-cols-3 gap-16">
                    <div class="flex flex-col gap-4">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/30">Layanan</h4>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Perpustakaan</a>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Pet Shop</a>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Komunitas</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/30">Perusahaan</h4>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Tentang Kami</a>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Karir</a>
                        <a href="#" class="text-sm font-semibold hover:text-biblo-moss transition">Kontak</a>
                    </div>
                    <div class="hidden lg:flex flex-col gap-4">
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/30">Ikuti Kami</h4>
                        <div class="flex gap-4">
                            <div class="w-10 h-10 bg-biblo-oat rounded-full flex items-center justify-center cursor-pointer hover:bg-biblo-sage transition">IG</div>
                            <div class="w-10 h-10 bg-biblo-oat rounded-full flex items-center justify-center cursor-pointer hover:bg-biblo-sage transition">TW</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-biblo-greige/10 flex flex-col md:flex-row justify-between items-center gap-6">
                <p class="text-[11px] text-biblo-charcoal/40 font-bold uppercase tracking-widest">
                    © 2026 BIBLO INTERACTIVE. ALL RIGHTS RESERVED.
                </p>
                <div class="flex gap-8 text-[11px] font-bold text-biblo-charcoal/40 uppercase tracking-widest">
                    <a href="#" class="hover:text-biblo-moss transition">Privacy</a>
                    <a href="#" class="hover:text-biblo-moss transition">Terms</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById('main-navbar');
        const logoLo = document.getElementById('logo-lo');
        const navLinks = document.getElementById('nav-links');
        const navLogin = document.getElementById('nav-login');
        const mobileToggle = document.getElementById('mobile-toggle');
        const mobileMenu = document.getElementById('mobile-menu');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 80) {
                navbar.classList.add('navbar-glass', 'py-4');
                navbar.classList.remove('py-6');
                logoLo.classList.replace('text-white', 'text-biblo-charcoal');
                navLinks.classList.replace('text-biblo-greige', 'text-biblo-charcoal/70');
                navLogin.classList.replace('text-biblo-greige', 'text-biblo-charcoal/80');
                mobileToggle.classList.replace('text-white', 'text-biblo-charcoal');
            } else {
                navbar.classList.remove('navbar-glass', 'py-4');
                navbar.classList.add('py-6');
                logoLo.classList.replace('text-biblo-charcoal', 'text-white');
                navLinks.classList.replace('text-biblo-charcoal/70', 'text-biblo-greige');
                navLogin.classList.replace('text-biblo-charcoal/80', 'text-biblo-greige');
                mobileToggle.classList.replace('text-biblo-charcoal', 'text-white');
            }
        });

        // Mobile Menu Toggle
        mobileToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
        
        // Close menu on click link
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });
    </script>
</body>
</html>
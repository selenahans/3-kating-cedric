<!DOCTYPE html>
<html lang="id">
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
    </style>
</head>
<body class="bg-biblo-oat text-biblo-charcoal overflow-x-hidden">

    <header class="bg-biblo-charcoal rounded-b-[50px] pt-10 pb-20 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none grid grid-cols-6 gap-10 p-10">
            <span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span>
        </div>

<nav id="main-navbar" class="fixed w-full z-[100] transition-all duration-500 py-6 px-6">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <div class="flex items-center gap-2 select-none cursor-pointer">
            <div class="flex items-center text-[24px] tracking-tight">
                <span class="font-extrabold text-biblo-moss">BIB</span>
                <span class="font-light text-biblo-charcoal">LO.</span>
            </div>
        </div>

        <div class="hidden md:flex items-center gap-10">
            <div class="flex gap-8 items-center text-sm font-bold text-biblo-charcoal/70">
                <a href="#features" class="hover:text-biblo-moss transition-colors">Fitur</a>
                <a href="#gamifikasi" class="hover:text-biblo-moss transition-colors">Sistem Pet</a>
                <a href="#faq" class="hover:text-biblo-moss transition-colors">FAQ</a>
            </div>
            <div class="h-5 w-[1px] bg-biblo-greige/40"></div>
            <div class="flex items-center gap-6">
                <a href="#" class="text-sm font-bold text-biblo-charcoal/80 hover:text-biblo-moss transition-colors">Masuk</a>
                <button class="bg-biblo-charcoal text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-biblo-moss transition-all hover:shadow-lg hover:shadow-biblo-moss/20">
                    Mulai Membaca
                </button>
            </div>
        </div>

        <button class="md:hidden text-biblo-charcoal p-2 focus:outline-none" id="mobile-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>
</nav>

<style>
    .navbar-scrolled {
        padding-top: 1rem !important;
        padding-bottom: 1rem !important;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-bottom: 1px solid rgba(159, 175, 154, 0.1);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
    }
</style>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h2 class="text-white text-5xl md:text-7xl font-extrabold mb-6 leading-tight">Membaca Jadi <br> Lebih Menyenangkan</h2>
            <p class="text-biblo-greige text-lg mb-10 max-w-xl mx-auto">Tumbuhkan kebiasaan literasi bersama pet digitalmu. Setiap halaman yang kamu baca adalah nutrisi bagi mereka.</p>
            
            <div class="relative inline-block">
                <div class="w-64 h-64 md:w-80 md:h-80 bg-biblo-moss/30 organic-shape absolute -top-4 -left-4 animate-pulse"></div>
                <div class="relative bg-biblo-greige w-64 h-64 md:w-80 md:h-80 organic-shape flex items-center justify-center text-8xl shadow-2xl">
                    🦉
                </div>
            </div>
        </div>
    </header>

    <section class="max-w-6xl mx-auto px-6 -mt-10 relative z-20">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-8 rounded-[40px] shadow-xl border border-biblo-greige/20">
                <div class="w-12 h-12 bg-biblo-sage/20 rounded-2xl flex items-center justify-center mb-6">📖</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-moss">Perpustakaan Luas</h3>
                <p class="text-biblo-charcoal/60 text-sm">Akses ribuan buku digital dari berbagai genre untuk menemani waktu luangmu.</p>
            </div>
            <div class="bg-white p-8 rounded-[40px] shadow-xl border border-biblo-greige/20 md:translate-y-8">
                <div class="w-12 h-12 bg-biblo-clay/20 rounded-2xl flex items-center justify-center mb-6">🐾</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-clay">Pet Interaktif</h3>
                <p class="text-biblo-charcoal/60 text-sm">Selesaikan target membaca harian untuk memberi makan dan mengembangkan pet-mu.</p>
            </div>
            <div class="bg-white p-8 rounded-[40px] shadow-xl border border-biblo-greige/20">
                <div class="w-12 h-12 bg-biblo-moss/20 rounded-2xl flex items-center justify-center mb-6">✨</div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Smart Highlight</h3>
                <p class="text-biblo-charcoal/60 text-sm">Simpan poin penting dan buat catatan pribadi dengan satu ketukan jari.</p>
            </div>
        </div>
    </section>

    <section class="bg-biblo-sage rounded-[50px] mt-24 py-20 px-6 mx-4">
        <div class="max-w-4xl mx-auto text-center text-white">
            <h2 class="text-3xl md:text-5xl font-extrabold mb-12">Bagaimana Biblo <br> Membantumu?</h2>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
                    <p class="text-xs font-bold uppercase tracking-widest mb-4 opacity-70">Langkah 01</p>
                    <h4 class="font-bold text-lg mb-2">Pilih Buku</h4>
                    <p class="text-sm opacity-80">Temukan bacaan favoritmu di katalog kami.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
                    <p class="text-xs font-bold uppercase tracking-widest mb-4 opacity-70">Langkah 02</p>
                    <h4 class="font-bold text-lg mb-2">Baca & Tandai</h4>
                    <p class="text-sm opacity-80">Gunakan fitur highlight untuk simpan ilmu.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl border border-white/20">
                    <p class="text-xs font-bold uppercase tracking-widest mb-4 opacity-70">Langkah 03</p>
                    <h4 class="font-bold text-lg mb-2">Rawat Pet</h4>
                    <p class="text-sm opacity-80">Lihat pet-mu tumbuh setiap hari!</p>
                </div>
            </div>

            <button class="mt-16 bg-biblo-charcoal text-white px-10 py-4 rounded-2xl font-bold shadow-2xl hover:scale-105 transition">
                Mulai Sekarang
            </button>
        </div>
    </section>
<section id="faq" class="py-24 px-6 max-w-4xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold text-biblo-charcoal mb-4">Punya Pertanyaan?</h2>
            <p class="text-biblo-charcoal/60 font-medium">Semua yang perlu kamu tahu tentang BIBLO.</p>
        </div>

        <div class="space-y-4">
            <div class="group border border-biblo-greige/30 rounded-3xl bg-white overflow-hidden transition-all duration-300 hover:border-biblo-sage shadow-sm">
                <input type="checkbox" id="faq-1" class="peer hidden">
                <label for="faq-1" class="flex justify-between items-center w-full p-6 cursor-pointer select-none">
                    <span class="text-lg font-bold text-biblo-charcoal">Apa itu BIBLO?</span>
                    <svg class="w-6 h-6 text-biblo-moss transition-transform duration-300 peer-checked:rotate-180 group-has-[:checked]:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <div class="max-h-0 overflow-hidden transition-all duration-300 group-has-[:checked]:max-h-40 bg-biblo-oat/30">
                    <div class="px-6 pb-6 text-biblo-charcoal/70 leading-relaxed text-sm">
                        BIBLO adalah platform literasi digital gamifikasi di mana kamu bisa membaca buku, menyimpan progress, dan merawat pet digital yang tumbuh seiring kebiasaan membacamu.
                    </div>
                </div>
            </div>

            <div class="group border border-biblo-greige/30 rounded-3xl bg-white overflow-hidden transition-all duration-300 hover:border-biblo-sage shadow-sm">
                <input type="checkbox" id="faq-2" class="peer hidden">
                <label for="faq-2" class="flex justify-between items-center w-full p-6 cursor-pointer select-none">
                    <span class="text-lg font-bold text-biblo-charcoal">Bagaimana cara menaikkan level Pet?</span>
                    <svg class="w-6 h-6 text-biblo-moss transition-transform duration-300 group-has-[:checked]:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <div class="max-h-0 overflow-hidden transition-all duration-300 group-has-[:checked]:max-h-40 bg-biblo-oat/30">
                    <div class="px-6 pb-6 text-biblo-charcoal/70 leading-relaxed text-sm">
                        Setiap halaman yang kamu baca akan memberikan XP kepada Pet milikmu. Semakin konsisten kamu membaca, semakin cepat Pet kamu berevolusi ke bentuk yang lebih keren.
                    </div>
                </div>
            </div>

            <div class="group border border-biblo-greige/30 rounded-3xl bg-white overflow-hidden transition-all duration-300 hover:border-biblo-sage shadow-sm">
                <input type="checkbox" id="faq-3" class="peer hidden">
                <label for="faq-3" class="flex justify-between items-center w-full p-6 cursor-pointer select-none">
                    <span class="text-lg font-bold text-biblo-charcoal">Apakah saya bisa membuat catatan pribadi?</span>
                    <svg class="w-6 h-6 text-biblo-moss transition-transform duration-300 group-has-[:checked]:rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </label>
                <div class="max-h-0 overflow-hidden transition-all duration-300 group-has-[:checked]:max-h-40 bg-biblo-oat/30">
                    <div class="px-6 pb-6 text-biblo-charcoal/70 leading-relaxed text-sm">
                        Tentu saja! BIBLO menyediakan fitur highlight untuk poin-poin penting dan ruang catatan pribadi di setiap bab buku yang kamu baca.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="bg-white border-t border-biblo-greige/20 pt-20 pb-10 px-6 mt-20">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 pb-16">
                <div class="max-w-xs">
                    <div class="flex items-center text-[26px] tracking-tight mb-4">
                        <span class="font-extrabold text-biblo-moss">BIB</span>
                        <span class="font-light text-biblo-charcoal">LO.</span>
                    </div>
                    <p class="text-sm text-biblo-charcoal/50 leading-relaxed">
                        Membangun generasi literat melalui pengalaman membaca yang interaktif dan menyenangkan.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-12 md:gap-24">
                    <div class="flex flex-col gap-4">
                        <h4 class="text-xs font-black uppercase tracking-widest text-biblo-charcoal/30">Platform</h4>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Perpustakaan</a>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Sistem Pet</a>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Leaderboard</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h4 class="text-xs font-black uppercase tracking-widest text-biblo-charcoal/30">Dukungan</h4>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Pusat Bantuan</a>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">FAQ</a>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Kontak</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <h4 class="text-xs font-black uppercase tracking-widest text-biblo-charcoal/30">Sosial</h4>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Instagram</a>
                        <a href="#" class="text-sm font-semibold text-biblo-charcoal/70 hover:text-biblo-moss transition">Twitter</a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-biblo-greige/10 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[12px] text-biblo-charcoal/40 font-medium">
                    © 2026 BIBLO. Grow your mind, grow your pet.
                </p>
                <div class="flex gap-6">
                    <a href="#" class="text-[12px] text-biblo-charcoal/40 hover:text-biblo-moss transition">Privacy Policy</a>
                    <a href="#" class="text-[12px] text-biblo-charcoal/40 hover:text-biblo-moss transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>
<script>
    const navbar = document.getElementById('main-navbar');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });

    // Mobile Toggle Simple Logic
    const mobileBtn = document.getElementById('mobile-toggle');
    mobileBtn.addEventListener('click', () => {
        // Kamu bisa tambahkan menu mobile di sini jika diperlukan
        alert('Menu Mobile Terbuka!'); 
    });
</script>
</body>
</html>
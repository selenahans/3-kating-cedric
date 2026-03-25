{{--
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .organic-shape {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }

        .navbar-glass {
            background: rgba(242, 239, 234, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(159, 175, 154, 0.2);
        }
    </style>
</head>

<body class="bg-biblo-oat text-biblo-charcoal">

    <nav id="main-navbar" class="fixed w-full z-[100] transition-all duration-500 py-6 px-6 flex justify-center">
        <div id="navbar-container"
            class="w-full max-w-7xl transition-all duration-500 rounded-[32px] px-8 py-4 flex justify-between items-center bg-transparent">

            <div class="flex items-center gap-2 select-none cursor-pointer">
                <a href="/" class="group">
                    <img src="{{ asset('images/logo/biblo.webp') }}" id="nav-logo" alt="Biblo Logo"
                        class="h-8 md:h-10 w-auto transition-all duration-300 group-hover:scale-105">
                </a>
            </div>

            <div class="hidden md:flex items-center gap-10">
                <div class="flex gap-8 items-center text-[11px] font-black uppercase tracking-[0.2em] text-biblo-greige"
                    id="nav-links">
                    <a href="#features" class="hover:text-biblo-sage transition-colors">Fitur</a>
                    <a href="#gamifikasi" class="hover:text-biblo-sage transition-colors">Sistem Pet</a>
                    <a href="#faq" class="hover:text-biblo-sage transition-colors">FAQ</a>
                </div>

                <div class="h-5 w-[1px] bg-biblo-greige/20"></div>

                <div class="flex items-center gap-8">
                    <a href="{{ route('login') }}"
                        class="text-[11px] font-black uppercase tracking-[0.2em] text-biblo-greige hover:text-biblo-charcoal transition-colors"
                        id="nav-login">
                        Masuk
                    </a>
                    <button
                        class="bg-biblo-moss text-white px-7 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-biblo-charcoal hover:-translate-y-1 active:translate-y-0 transition-all shadow-xl shadow-biblo-moss/20">
                        Mulai Membaca
                    </button>
                </div>
            </div>

            <button class="md:hidden text-biblo-charcoal p-2 hover:bg-biblo-oat rounded-xl transition-colors"
                id="mobile-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>

        <div id="mobile-menu"
            class="hidden absolute top-full left-6 right-6 bg-white/90 backdrop-blur-2xl shadow-2xl p-8 flex flex-col gap-6 text-center md:hidden border border-biblo-oat mt-4 rounded-[32px] overflow-hidden">
            <div class="flex flex-col gap-4 text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60">
                <a href="#features" class="py-2 hover:text-biblo-moss transition-colors">Fitur</a>
                <a href="#gamifikasi" class="py-2 hover:text-biblo-moss transition-colors">Sistem Pet</a>
                <a href="#faq" class="py-2 hover:text-biblo-moss transition-colors">FAQ</a>
            </div>
            <hr class="border-biblo-oat">
            <button
                class="bg-biblo-charcoal text-white py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest">
                Mulai Membaca
            </button>
        </div>
    </nav>

    <header class="bg-biblo-charcoal rounded-b-[60px] pt-40 pb-32 px-6 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 pointer-events-none grid grid-cols-6 gap-10 p-10">
            <span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span>
            <span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span>
        </div>

        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span
                class="inline-block py-2 px-4 bg-biblo-moss/20 text-biblo-sage rounded-full text-xs font-bold tracking-widest uppercase mb-6">
                ✨ Partner Literasi Digital No. 1
            </span>
            <h1 class="text-white text-5xl md:text-7xl font-extrabold mb-8 leading-[1.1]">
                Membaca Jadi <br> <span class="text-biblo-sage">Lebih Hidup.</span>
            </h1>
            <p class="text-biblo-greige/80 text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed">
                Tumbuhkan kebiasaan membaca bersama pet digitalmu. Setiap halaman yang kamu selesaikan adalah nutrisi
                untuk pertumbuhannya.
            </p>

            <div class="relative inline-block group">
                <div
                    class="w-64 h-64 md:w-80 md:h-80 bg-biblo-moss/20 organic-shape absolute -top-6 -left-6 animate-pulse transition-transform group-hover:scale-110">
                </div>
                <div
                    class="relative bg-biblo-greige w-64 h-64 md:w-80 md:h-80 organic-shape flex items-center justify-center text-8xl shadow-2xl transform transition-transform group-hover:rotate-6">
                    🦉
                </div>
            </div>
        </div>
    </header>







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

</html> --}}


<x-guest-layout title="Selamat Datang di Biblo">

    <header class="bg-biblo-charcoal rounded-b-[60px] pt-48 pb-40 px-6 relative overflow-hidden text-center">
        <div class="absolute inset-0 opacity-5 pointer-events-none grid grid-cols-6 gap-10 p-10">
            <span>📖</span><span>🐾</span><span>📖</span><span>🐾</span><span>📖</span><span>🐾</span>
        </div>

        <div class="max-w-4xl mx-auto relative z-10">


            <h1 class="text-white text-5xl md:text-7xl font-extrabold mb-8 leading-[1.1] tracking-tighter">
                Membaca Jadi <br> <span class="text-biblo-sage italic">Lebih Hidup.</span>
            </h1>

            <p class="text-biblo-greige/80 text-lg md:text-xl mb-16 max-w-2xl mx-auto leading-relaxed">
                Tumbuhkan kebiasaan membaca bersama pet digitalmu. Setiap halaman adalah nutrisi pertumbuhannya.
            </p>

            <div class="relative inline-block group">
                <div
                    class="w-72 h-72 md:w-96 md:h-96 bg-biblo-moss/10 organic-shape absolute -top-8 -left-8 animate-pulse group-hover:scale-110 transition-transform duration-700">
                </div>

                <div
                    class="relative w-72 h-72 md:w-96 md:h-96 organic-shape flex items-center justify-center shadow-2xl transition-transform duration-700 group-hover:scale-105 overflow-hidden">

                    <img src="{{ asset('images/boo.webp') }}" alt="Boo Companion"
                        class="w-full h-full object-contain p-10 animate-float-slow">
                </div>
            </div>
        </div>
    </header>
    <section id="features" class="max-w-6xl mx-auto px-6 -mt-16 relative z-20">
        <div class="grid md:grid-cols-3 gap-8">
            <div
                class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 hover:translate-y-[-5px] transition-transform">
                <div class="w-14 h-14 bg-biblo-sage/10 rounded-2xl flex items-center justify-center text-2xl mb-8">📖
                </div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Perpustakaan Luas</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Akses ribuan buku digital dari berbagai genre
                    untuk menemani waktu luangmu kapan saja.</p>
            </div>
            <div
                class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 md:translate-y-12 hover:translate-y-[43px] transition-transform">
                <div class="w-14 h-14 bg-biblo-clay/10 rounded-2xl flex items-center justify-center text-2xl mb-8">🐾
                </div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Pet Interaktif</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Selesaikan target harian untuk memberi makan
                    dan berevolusi bersama teman digitalmu.</p>
            </div>
            <div
                class="bg-white p-10 rounded-[40px] shadow-xl border border-biblo-greige/10 hover:translate-y-[-5px] transition-transform">
                <div class="w-14 h-14 bg-biblo-moss/10 rounded-2xl flex items-center justify-center text-2xl mb-8">✨
                </div>
                <h3 class="font-bold text-xl mb-4 text-biblo-charcoal">Smart Highlight</h3>
                <p class="text-biblo-charcoal/60 text-sm leading-relaxed">Simpan poin penting dan buat catatan pribadi
                    secara otomatis yang tersinkronisasi.</p>
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
                    <p class="text-sm text-white/80">Gunakan fitur cerdas untuk menangkap ide-ide brilian di setiap bab.
                    </p>
                </div>
                <div class="bg-white/10 backdrop-blur-xl p-8 rounded-[40px] border border-white/20">
                    <span class="text-4xl block mb-6">📈</span>
                    <h4 class="font-extrabold text-xl mb-3">03. Rawat Pet</h4>
                    <p class="text-sm text-white/80">Lihat progressmu mewujud dalam evolusi pet yang unik dan keren!</p>
                </div>
            </div>

            <button
                class="mt-20 bg-biblo-charcoal text-white px-12 py-5 rounded-2xl font-bold shadow-2xl hover:bg-black transition-all hover:scale-105">
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
            <details
                class="group bg-white rounded-[32px] border border-biblo-greige/20 shadow-sm overflow-hidden transition-all">
                <summary class="flex justify-between items-center p-8 cursor-pointer list-none">
                    <span class="text-lg font-bold">Apa itu sebenarnya BIBLO?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="px-8 pb-8 text-biblo-charcoal/60 leading-relaxed">
                    BIBLO adalah ekosistem membaca digital yang menggabungkan pembaca buku (e-reader) dengan elemen game
                    (gamifikasi) untuk membangun kebiasaan literasi yang konsisten.
                </div>
            </details>

            <details
                class="group bg-white rounded-[32px] border border-biblo-greige/20 shadow-sm overflow-hidden transition-all">
                <summary class="flex justify-between items-center p-8 cursor-pointer list-none">
                    <span class="text-lg font-bold">Apakah Pet saya bisa mati?</span>
                    <span class="transition group-open:rotate-180">
                        <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="px-8 pb-8 text-biblo-charcoal/60 leading-relaxed">
                    Tenang saja! Pet tidak akan mati, namun mereka akan menjadi lemas dan tidak berkembang jika kamu
                    tidak membaca dalam waktu lama. Membaca kembali akan mengembalikan energi mereka.
                </div>
            </details>
        </div>
    </section>

</x-guest-layout>
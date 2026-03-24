<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 — Halaman Hilang | Biblo</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Menggunakan kelengkungan yang sama dengan landing page-mu */
        .error-container {
            border-bottom-left-radius: 60px;
            border-bottom-right-radius: 60px;
        }
        /* Style untuk organic shape di belakang gambar */
        .organic-shape {
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
        }
    </style>
</head>
<body class="antialiased bg-white">

    {{-- Header Section (Mengikuti Style Header Landing Page) --}}
    <header class="bg-biblo-charcoal error-container pt-32 pb-40 px-6 relative overflow-hidden text-center">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none grid grid-cols-6 gap-10 p-10">
            <span>❓</span><span>🔍</span><span>❓</span><span>🔍</span><span>❓</span><span>🔍</span>
        </div>

        <div class="max-w-4xl mx-auto relative z-10">
            
            {{-- TEMPAT GAMBAR (Organic Shape & Float Animation) --}}
            <div class="relative inline-block group mb-12">
                <div class="w-64 h-64 md:w-80 md:h-80 bg-biblo-moss/10 organic-shape absolute -top-4 -left-4 animate-pulse">
                </div>

                <div class="relative w-64 h-64 md:w-80 md:h-80 organic-shape bg-white/5 backdrop-blur-sm flex items-center justify-center shadow-2xl overflow-hidden border border-white/10">
                    {{-- Ganti src ini dengan image 404-mu nanti --}}
                    <img src="{{ asset('images/boo-error.webp') }}" alt="Page Not Found"
                        class="w-full h-full object-contain p-12 animate-float-slow">
                </div>
            </div>

            <h1 class="text-white text-5xl md:text-6xl font-extrabold mb-6 leading-[1.1] tracking-tighter">
                Ups! Jejaknya <br> <span class="text-biblo-sage italic">Terputus.</span>
            </h1>

            <p class="text-biblo-greige/80 text-lg mb-12 max-w-lg mx-auto leading-relaxed">
                Boo tidak bisa menemukan halaman yang kamu cari. Mungkin halamannya terselip di antara ribuan rak buku kami.
            </p>

            {{-- TOMBOL (Style sesuai button landing page) --}}
            <a href="{{ url('/') }}"
                class="inline-block bg-biblo-sage text-biblo-charcoal px-12 py-5 rounded-2xl font-bold shadow-2xl hover:bg-white transition-all hover:scale-105">
                Kembali ke Perpustakaan
            </a>
        </div>
    </header>

    {{-- Footer Simple --}}
    <footer class="py-12 text-center text-biblo-charcoal/30 text-sm font-medium">
        &copy; {{ date('Y') }} Biblo — Reading Companion.
    </footer>

</body>
</html>
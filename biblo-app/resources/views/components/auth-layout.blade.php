<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Biblo' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .input-box { @apply w-full border-none rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-biblo-moss/30 transition-all font-semibold shadow-sm; }
        label { @apply block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1; }
    </style>
</head>
<body class="bg-[#F4F2F0] h-screen w-screen flex items-center justify-center p-4 md:p-10">

    <div class="bg-white w-full max-w-6xl h-full max-h-[720px] rounded-[3.5rem] overflow-hidden flex shadow-2xl">
        
        <div id="slider-container" class="hidden md:flex md:w-[42%] bg-biblo-purple p-10 flex-col items-center justify-center text-center relative overflow-hidden transition-colors duration-1000">
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-white/10 rounded-full"></div>
            
            <div id="slide-content" class="relative z-10 transition-all duration-500">
                <div id="slide-icon" class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-[2.5rem] flex items-center justify-center text-5xl mx-auto mb-8 shadow-xl">
                    {{ $icon ?? '🌱' }}
                </div>
                <h2 id="slide-title" class="text-white text-3xl font-extrabold mb-4 leading-tight">{!! $slideTitle ?? 'Awal Baru <br> Menantimu.' !!}</h2>
                <p id="slide-desc" class="text-white/70 text-sm max-w-[260px] mx-auto leading-relaxed">
                    {{ $slideDesc ?? 'Daftar sekarang dan biarkan pet digitalmu tumbuh seiring bertambahnya ilmu.' }}
                </p>
            </div>

            <div class="absolute bottom-12 flex items-center gap-2">
                <div class="dot w-8 h-2 rounded-full bg-white transition-all duration-300"></div>
                <div class="dot w-2 h-2 rounded-full bg-white/30 transition-all duration-300"></div>
                <div class="dot w-2 h-2 rounded-full bg-white/30 transition-all duration-300"></div>
            </div>
        </div>

        <div class="w-full md:w-[58%] px-10 py-8 flex flex-col relative">
            {{ $slot }}
        </div>
    </div>

    @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulihkan Akun - Biblo</title>
    
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
                        'biblo-purple': '#A688CC',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; overflow: hidden; }
        .input-box { 
            @apply w-full border-none rounded-2xl px-5 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-biblo-moss/30 transition-all font-semibold shadow-sm; 
        }
        label { 
            @apply block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1; 
        }
        /* Custom scrollbar just in case screen is very small */
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#F4F2F0] h-screen w-screen flex items-center justify-center p-4 md:p-10">

    <div class="bg-white w-full max-w-6xl h-full max-h-[700px] rounded-[3.5rem] overflow-hidden flex shadow-2xl transition-all duration-300">
        
        <div id="slider-container" class="hidden md:flex md:w-[42%] bg-biblo-purple p-10 flex-col items-center justify-center text-center relative overflow-hidden transition-colors duration-1000">
            <div class="absolute -top-20 -left-20 w-80 h-80 bg-white/10 rounded-full"></div>
            <div class="absolute top-1/3 -right-20 w-64 h-64 bg-white/5 rounded-full"></div>
            
            <div id="slide-content" class="relative z-10 transition-all duration-500">
                <div id="slide-icon" class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-[2.5rem] flex items-center justify-center text-5xl mx-auto mb-8 shadow-xl">
                    🔑
                </div>
                <h2 id="slide-title" class="text-white text-3xl font-extrabold mb-4 leading-tight">Keamanan <br> Adalah Kunci.</h2>
                <p id="slide-desc" class="text-white/70 text-sm max-w-[260px] mx-auto leading-relaxed">
                    Jangan khawatir, kami akan membantu memulihkan akses ke perpustakaan digitalmu.
                </p>
            </div>

            <div class="absolute bottom-12 flex items-center gap-2">
                <div class="dot w-8 h-2 rounded-full bg-white transition-all duration-300"></div>
                <div class="dot w-2 h-2 rounded-full bg-white/30 transition-all duration-300"></div>
                <div class="dot w-2 h-2 rounded-full bg-white/30 transition-all duration-300"></div>
            </div>
        </div>

        <div class="w-full md:w-[58%] px-8 md:px-12 py-8 flex flex-col justify-between">
            
            <div class="flex justify-between items-center">
                <a href="/">
                    <img src="{{ asset('images/logo/biblo.webp') }}" alt="Logo" class="h-7 w-auto object-contain">
                </a>
                <div class="text-[11px] font-bold">
                    <span class="text-biblo-charcoal/40 font-medium">Ingat sandi?</span>
                    <a href="{{ route('login') }}" class="text-biblo-charcoal font-bold hover:underline ml-1">Masuk</a>
                </div>
            </div>

            <div class="max-w-md mx-auto w-full flex-1 flex flex-col justify-center py-8">
                <div class="mb-8 text-center md:text-left">
                    <h1 class="text-4xl font-extrabold text-biblo-charcoal mb-2">Lupa Kata Sandi</h1>
                    <p class="text-biblo-charcoal/40 text-xs font-semibold leading-relaxed">
                        Masukkan emailmu untuk mendapatkan instruksi reset password melalui email.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 text-xs font-bold text-green-600 bg-green-50 p-4 rounded-2xl border border-green-100 flex items-center gap-2">
                        <span>✅</span> {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label>Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@gmail.com" class="input-box bg-[#F8F9FA]">
                        @error('email') 
                            <span class="text-[10px] text-red-500 mt-2 block font-bold ml-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <button type="submit" 
                        class="w-full bg-biblo-charcoal hover:bg-black text-white py-4 rounded-2xl font-extrabold text-sm shadow-xl transition-all transform hover:scale-[1.01] active:scale-[0.98]">
                        Kirim Tautan Reset
                    </button>
                </form>

                <div class="relative my-8 text-center">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
                    <span class="relative bg-white px-4 text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/20">Atau hubungi bantuan</span>
                </div>

                <a href="#" class="w-full text-center py-3.5 border border-gray-100 rounded-2xl text-[11px] font-bold text-biblo-charcoal/40 hover:bg-gray-50 transition-all transform hover:translate-y-[-1px]">
                    Hubungi Pusat Bantuan
                </a>
            </div>

            <p class="text-center text-[10px] font-black text-biblo-charcoal/20 tracking-widest uppercase">
                © 2026 BIBLO INTERACTIVE.
            </p>
        </div>
    </div>

    <script>
        const slides = [
            { icon: '🔑', title: 'Keamanan <br> Adalah Kunci.', desc: 'Kami menjaga akunmu tetap aman setiap saat.', color: '#A688CC' },
            { icon: '📩', title: 'Cek Kotak <br> Masukmu.', desc: 'Link pemulihan akan dikirim langsung ke email terdaftar.', color: '#9FAF9A' },
            { icon: '🦉', title: 'Kembali <br> Membaca.', desc: 'Hanya butuh beberapa menit untuk memulihkan aksesmu.', color: '#B09D85' }
        ];

        let current = 0;
        const iconEl = document.getElementById('slide-icon');
        const titleEl = document.getElementById('slide-title');
        const descEl = document.getElementById('slide-desc');
        const containerEl = document.getElementById('slider-container');
        const dots = document.querySelectorAll('.dot');
        const slideContent = document.getElementById('slide-content');

        function updateSlide() {
            current = (current + 1) % slides.length;
            
            // Animasi Fade Out
            slideContent.style.opacity = 0;
            slideContent.style.transform = 'translateY(-10px)';

            setTimeout(() => {
                iconEl.innerText = slides[current].icon;
                titleEl.innerHTML = slides[current].title;
                descEl.innerText = slides[current].desc;
                containerEl.style.backgroundColor = slides[current].color;

                // Update Dots
                dots.forEach((dot, index) => {
                    if(index === current) {
                        dot.classList.add('w-8', 'bg-white');
                        dot.classList.remove('w-2', 'bg-white/30');
                    } else {
                        dot.classList.remove('w-8', 'bg-white');
                        dot.classList.add('w-2', 'bg-white/30');
                    }
                });

                // Animasi Fade In
                slideContent.style.opacity = 1;
                slideContent.style.transform = 'translateY(0)';
            }, 500);
        }

        setInterval(updateSlide, 5000);
    </script>
</body>
</html>
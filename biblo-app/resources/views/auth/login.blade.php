<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Biblo</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'biblo-charcoal': '#2D2D2A',
                        'biblo-greige': '#D1D1C7',
                        'biblo-moss': '#4A5D23',
                        'biblo-sage': '#8E9E82',
                        'biblo-clay': '#C07858',
                        'biblo-oat': '#F4EFE6',
                        'biblo-cream': '#FDFBF8'
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        },
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    },
                    fontFamily: {
                        'jakarta': ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .input-field {
            width: 100%;
            border: 1.5px solid rgba(209, 209, 199, 0.4);
            border-radius: 1.2rem;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            color: #2D2D2A;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: #F4EFE6;
        }

        .input-field:focus {
            outline: none;
            border-color: #4A5D23;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(74, 93, 35, 0.1);
        }

        .input-field:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #FDFBF8 inset !important;
            -webkit-text-fill-color: #2D2D2A !important;
        }
    </style>
</head>

<body class="bg-biblo-cream text-biblo-charcoal font-jakarta overflow-x-hidden">

    <div class="min-h-screen flex w-full">
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-16 relative bg-biblo-cream z-10">
            <div class="w-full max-w-[400px] animate-fade-in-up">

                {{-- Mobile Brand --}}
                <div class="lg:hidden mb-8 px-4">
                    <a href="/" class="block">
                        <img src="{{ asset('images/logo/biblo.webp') }}" alt="Biblo Logo"
                            class="h-8 w-auto object-contain">
                    </a>
                </div>

                @if(session('error'))
                    <div
                        class="bg-biblo-clay/10 text-biblo-clay border border-biblo-clay/20 font-bold p-4 rounded-2xl mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-2">Selamat Datang Kembali</p>
                <h1 class="text-4xl font-extrabold mb-3 tracking-tight">Selamat Datang</h1>
                <p class="text-biblo-charcoal/60 mb-10 leading-relaxed font-medium">
                    Masuk untuk melanjutkan membaca koleksi buku favorit Anda.
                </p>

                <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email"
                            class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="nama@email.com" class="input-field"
                            required>
                    </div>

<div class="relative">
    <input type="password" name="password" id="password" placeholder="••••••••"
        class="input-field pr-11" required>
    <button type="button"
        class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 text-biblo-charcoal/40 hover:text-biblo-moss transition p-1"
        data-target="password">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 eye-open">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 eye-closed hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.822 7.822L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
        </svg>
    </button>
</div>

                    <button type="submit"
                        class="w-full bg-biblo-charcoal text-white py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                        Masuk Sekarang
                    </button>
                </form>

                <p class="mt-10 text-center text-biblo-charcoal/60 font-medium text-sm">
                    Belum punya akun? <a href="{{ route('register') }}"
                        class="font-extrabold text-biblo-charcoal hover:text-biblo-moss transition-colors">Daftar di
                        sini</a>
                </p>
            </div>
        </div>

        <div
            class="hidden lg:flex lg:w-1/2 bg-biblo-oat border-l border-biblo-greige/20 relative items-center justify-center overflow-hidden">
            {{-- Decorative Elements --}}
            <div
                class="absolute w-[600px] h-[600px] bg-biblo-sage/20 rounded-full blur-3xl opacity-60 -top-20 -right-20 pointer-events-none">
            </div>
            <div
                class="absolute w-[400px] h-[400px] bg-biblo-clay/10 rounded-full blur-3xl opacity-50 bottom-0 left-0 pointer-events-none">
            </div>

            <div class="relative z-10 text-center max-w-lg px-6">
                {{-- Logo --}}
                <div class="absolute top-10 left-10 text-4xl font-extrabold tracking-tighter text-biblo-charcoal">
                    Biblo.
                </div>

                {{-- CSS-based Illustration (Safe from broken links) --}}
                <div class="relative w-[300px] h-[300px] mx-auto mb-10 flex items-center justify-center">
                    <div class="absolute inset-0 bg-biblo-moss/10 rounded-full blur-2xl animate-pulse"></div>
                    <span class="text-[120px] animate-float block drop-shadow-2xl">📖</span>
                </div>

                <h2 class="text-4xl font-extrabold text-biblo-charcoal mb-4 leading-tight tracking-tight">
                    Lanjutkan <span class="text-biblo-moss italic">Petualangan</span> Menulismu
                </h2>
                <p class="text-biblo-charcoal/60 font-medium leading-relaxed">
                    Setiap halaman yang Anda baca membawa Anda selangkah lebih dekat ke wawasan baru yang luar biasa.
                </p>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButtons = document.querySelectorAll('.toggle-pass');

        toggleButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const eyeOpen = this.querySelector('.eye-open');
                const eyeClosed = this.querySelector('.eye-closed');

                // Toggle type
                const isPassword = input.getAttribute('type') === 'password';
                input.setAttribute('type', isPassword ? 'text' : 'password');

                // Toggle Ikon Mata
                if (isPassword) {
                    eyeOpen.classList.add('hidden');
                    eyeClosed.classList.remove('hidden');
                    this.style.color = '#4A5D23'; // Warna biblo-moss
                } else {
                    eyeOpen.classList.remove('hidden');
                    eyeClosed.classList.add('hidden');
                    this.style.color = 'rgba(45, 45, 42, 0.4)'; // Warna charcoal/40
                }
            });
        });
    });
</script>
</body>

</html>
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

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

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
                <div class="lg:hidden mb-8">
                    <span class="text-2xl font-black tracking-tighter text-biblo-moss">Biblo.</span>
                </div>

                @if(session('error'))
                    <div class="bg-biblo-clay/10 text-biblo-clay border border-biblo-clay/20 font-bold p-4 rounded-2xl mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-2">Welcome Back</p>
                <h1 class="text-4xl font-extrabold mb-3 tracking-tight">Selamat Datang</h1>
                <p class="text-biblo-charcoal/60 mb-10 leading-relaxed font-medium">
                    Masuk untuk melanjutkan membaca koleksi buku favorit Anda.
                </p>

                <form action="{{ route('login.process') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="email" class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="nama@email.com" class="input-field" required>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2 ml-1">
                            <label for="password" class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60">Password</label>
                            <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-biblo-clay uppercase tracking-widest hover:underline">Lupa?</a>
                        </div>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="input-field" required>
                    </div>

                    <button type="submit" class="w-full bg-biblo-charcoal text-white py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                        Masuk Sekarang
                    </button>
                </form>

                <p class="mt-10 text-center text-biblo-charcoal/60 font-medium text-sm">
                    Belum punya akun? <a href="{{ route('register') }}" class="font-extrabold text-biblo-charcoal hover:text-biblo-moss transition-colors">Daftar di sini</a>
                </p>
            </div>
        </div>

        <div class="hidden lg:flex lg:w-1/2 bg-biblo-oat border-l border-biblo-greige/20 relative items-center justify-center overflow-hidden">
            {{-- Decorative Elements --}}
            <div class="absolute w-[600px] h-[600px] bg-biblo-sage/20 rounded-full blur-3xl opacity-60 -top-20 -right-20 pointer-events-none"></div>
            <div class="absolute w-[400px] h-[400px] bg-biblo-clay/10 rounded-full blur-3xl opacity-50 bottom-0 left-0 pointer-events-none"></div>

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
</body>

</html>
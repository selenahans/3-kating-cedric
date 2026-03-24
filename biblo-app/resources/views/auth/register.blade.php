<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Biblo</title>

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
            background-color: #FDFBF8;
            /* biblo-cream */
        }

        .input-field:-webkit-autofill,
        .input-field:-webkit-autofill:hover,
        .input-field:-webkit-autofill:focus,
        .input-field:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px #FDFBF8 inset !important;
            -webkit-text-fill-color: #2D2D2A !important;
            transition: background-color 5000s ease-in-out 0s;
        }

        .input-field:focus:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 30px #ffffff inset !important;
        }

        /* Styling Input Custom */
        .input-field {
            width: 100%;
            border: 1.5px solid rgba(209, 209, 199, 0.4);
            /* biblo-greige/40 */
            border-radius: 1.2rem;
            padding: 1rem 1.25rem;
            font-size: 0.95rem;
            color: #2D2D2A;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: #F4EFE6;
            /* biblo-oat */
        }

        .input-field:focus {
            outline: none;
            border-color: #4A5D23;
            /* biblo-moss */
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(74, 93, 35, 0.1);
        }

        .input-field::placeholder {
            color: rgba(45, 45, 42, 0.4);
            font-weight: 500;
        }
    </style>
</head>

<body class="text-biblo-charcoal font-jakarta overflow-x-hidden">

    <div class="min-h-screen flex w-full">
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 lg:p-16 relative bg-biblo-cream z-10">
            <div class="w-full max-w-[440px] animate-fade-in-up">

                {{-- Mobile Logo --}}
                <div class="lg:hidden mb-6 flex items-center select-none px-1">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo/biblo.webp') }}" alt="Biblo Logo"
                            class="h-7 w-auto object-contain transition-transform active:scale-95">
                    </a>
                </div>

                @if(session('error'))
                    <div
                        class="bg-biblo-clay/10 text-biblo-clay border border-biblo-clay/20 font-bold p-4 rounded-2xl mb-6 text-sm">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-2">Welcome</p>
                <h1 class="text-3xl lg:text-4xl font-extrabold mb-3 text-biblo-charcoal tracking-tight">Mulai
                    Perjalananmu!</h1>
                <p class="text-biblo-charcoal/60 mb-8 leading-relaxed text-sm font-medium">
                    Daftar sekarang dan mulailah membangun kebiasaan membacamu untuk masa depan yang lebih berwawasan.
                </p>

                <form action="{{route('register.process')}}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label for="name"
                            class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Nama
                            Lengkap</label>
                        <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap" class="input-field"
                            required>
                    </div>

                    <div>
                        <label for="email"
                            class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Email</label>
                        <input type="email" name="email" id="email" placeholder="contoh@email.com" class="input-field"
                            required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="relative">
                            <label for="password"
                                class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Kata
                                Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" placeholder="••••••••"
                                    class="input-field pr-11" required>
                                <button type="button"
                                    class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 text-biblo-charcoal/40 hover:text-biblo-moss transition p-1"
                                    data-target="password">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="relative">
                            <label for="password_confirmation"
                                class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Konfirmasi</label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    placeholder="••••••••" class="input-field pr-11" required>
                                <button type="button"
                                    class="toggle-pass absolute right-3 top-1/2 -translate-y-1/2 text-biblo-charcoal/40 hover:text-biblo-moss transition p-1"
                                    data-target="password_confirmation">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start gap-3 pt-2">
                        <input id="terms" name="terms" type="checkbox"
                            class="mt-1 h-5 w-5 text-biblo-moss focus:ring-biblo-moss border-biblo-greige/40 rounded-md bg-biblo-oat"
                            required>
                        <label for="terms" class="text-xs text-biblo-charcoal/60 font-medium leading-normal">
                            Saya setuju dengan <a href="#" class="text-biblo-charcoal font-bold hover:underline">Syarat
                                & Ketentuan</a> serta <a href="#"
                                class="text-biblo-charcoal font-bold hover:underline">Kebijakan Privasi</a> yang
                            berlaku.
                        </label>
                    </div>

                    @if ($errors->any())
                        <p class="text-biblo-clay text-sm font-bold mt-1">
                            {{ $errors->first() }}
                        </p>
                    @endif

                    <button type="submit"
                        class="w-full bg-biblo-charcoal text-white py-5 mt-4 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                        Buat Akun Sekarang
                    </button>
                </form>

                <p class="mt-8 text-center text-biblo-charcoal/60 font-medium text-sm">
                    Sudah punya akun? <a href="{{ route('login') }}"
                        class="font-extrabold text-biblo-charcoal hover:text-biblo-moss transition-colors">Masuk di
                        sini</a>
                </p>
            </div>
        </div>

        {{-- Right Side / Hero Image Area --}}
        <div
            class="hidden lg:flex lg:w-1/2 bg-biblo-oat border-l border-biblo-greige/20 relative items-center justify-center overflow-hidden">
            {{-- Decorative Blobs --}}
            <div
                class="absolute w-[600px] h-[600px] bg-biblo-sage/20 rounded-full blur-3xl opacity-60 -top-20 -right-20 pointer-events-none">
            </div>
            <div
                class="absolute w-[400px] h-[400px] bg-biblo-clay/10 rounded-full blur-3xl opacity-50 bottom-0 left-0 pointer-events-none">
            </div>

            <div class="relative z-10 text-center max-w-lg px-6">

                {{-- Logo Area on the graphic side --}}
                <div class="absolute top-10 left-10 text-4xl font-extrabold tracking-tighter text-biblo-charcoal">
                    Biblo.
                </div>

                <div class="relative w-[300px] h-[300px] mx-auto mb-10">
                    <div class="absolute inset-0 bg-biblo-moss/5 rounded-full blur-2xl"></div>
                    {{-- Feel free to change the src to an illustration of books! --}}
                    <span class="text-9xl animate-float block drop-shadow-2xl">📚</span>
                </div>

                <h2 class="text-4xl font-extrabold text-biblo-charcoal mb-4 leading-tight tracking-tight">
                    Selangkah lagi menuju <br> <span class="text-biblo-moss italic">Dunia Pengetahuan</span>
                </h2>
                <p class="text-biblo-charcoal/60 font-medium">
                    Gabung bersama 10.000+ pembaca lainnya yang telah berhasil menemukan wawasan baru setiap harinya.
                </p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Toggle Password Visibility Logic
            const toggleButtons = document.querySelectorAll('.toggle-pass');

            toggleButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const input = document.getElementById(targetId);

                    // Toggle type
                    const isPassword = input.getAttribute('type') === 'password';
                    input.setAttribute('type', isPassword ? 'text' : 'password');

                    // Update Icon color
                    this.style.color = isPassword ? '#4A5D23' : 'rgba(45, 45, 42, 0.4)';
                });
            });
        });
    </script>
</body>

</html>
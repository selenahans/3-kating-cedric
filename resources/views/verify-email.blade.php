<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Biblo</title>

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
                    fontFamily: {
                        'jakarta': ['"Plus Jakarta Sans"', 'sans-serif'],
                    },
                    animation: {
                        'fade-in-up': 'fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1)',
                    },
                    keyframes: {
                        fadeInUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-biblo-cream text-biblo-charcoal font-jakarta min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-md bg-white rounded-[2.5rem] shadow-xl p-10 border border-biblo-greige/20 animate-fade-in-up text-center">
        
        <div class="mb-8">
            <div class="w-20 h-20 bg-biblo-oat rounded-[2rem] flex items-center justify-center text-4xl mx-auto shadow-inner border border-biblo-greige/10">
                📩
            </div>
        </div>

        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-2">Security</p>
        <h2 class="text-3xl font-extrabold tracking-tight mb-4">
            Verifikasi Email
        </h2>

        <p class="text-biblo-charcoal/60 mb-8 leading-relaxed font-medium">
            Kami telah mengirimkan link verifikasi ke email Anda.  
            Silakan cek inbox dan klik link tersebut untuk mulai menjelajahi koleksi buku di Biblo.
        </p>

        @if (session('message'))
            <div class="bg-biblo-sage/10 text-biblo-moss border border-biblo-sage/20 p-4 rounded-2xl mb-6 text-sm font-bold">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="space-y-4">
            @csrf
            <button type="submit"
                class="w-full bg-biblo-charcoal text-white py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                Kirim Ulang Email
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-biblo-greige/20">
            <a href="{{ route('register') }}" class="text-xs font-black uppercase tracking-widest text-biblo-charcoal/40 hover:text-biblo-moss transition-colors">
                ← Kembali ke Registrasi
            </a>
        </div>
    </div>

</body>
</html>
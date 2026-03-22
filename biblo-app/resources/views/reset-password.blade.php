<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Biblo</title>

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
                        jakarta: ['"Plus Jakarta Sans"', 'sans-serif'],
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
                },
            },
        }
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
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
    </style>
</head>

<body class="min-h-screen bg-biblo-cream flex items-center justify-center font-jakarta p-4 text-biblo-charcoal">

    <div class="w-full max-w-md bg-white rounded-[2rem] shadow-xl p-8 border border-biblo-greige/20 animate-fade-in-up">

        <div class="flex flex-col items-center mb-8 text-center">
            <h2 class="text-3xl font-extrabold tracking-tighter text-biblo-moss mb-4">Biblo.</h2>
            <h1 class="text-2xl font-extrabold tracking-tight">
                Reset Password
            </h1>
            <p class="text-sm font-medium text-biblo-charcoal/60 mt-2">
                Buat password baru untuk akun Anda dan kembali membaca.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-2xl bg-biblo-clay/10 text-biblo-clay border border-biblo-clay/20 text-sm font-bold">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div>
                <label class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="input-field w-full px-5 py-4 rounded-[1.2rem] border-[1.5px] border-biblo-greige/40 bg-biblo-oat focus:outline-none focus:border-biblo-moss focus:bg-white focus:ring-4 focus:ring-biblo-moss/10 transition-all font-semibold text-biblo-charcoal"
                >
            </div>

            <div>
                <label class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Password Baru</label>
                <input
                    type="password"
                    name="password"
                    required
                    class="input-field w-full px-5 py-4 rounded-[1.2rem] border-[1.5px] border-biblo-greige/40 bg-biblo-oat focus:outline-none focus:border-biblo-moss focus:bg-white focus:ring-4 focus:ring-biblo-moss/10 transition-all font-semibold text-biblo-charcoal"
                >
            </div>

            <div>
                <label class="block text-[11px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-2 ml-1">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    required
                    class="input-field w-full px-5 py-4 rounded-[1.2rem] border-[1.5px] border-biblo-greige/40 bg-biblo-oat focus:outline-none focus:border-biblo-moss focus:bg-white focus:ring-4 focus:ring-biblo-moss/10 transition-all font-semibold text-biblo-charcoal"
                >
            </div>

            <button
                type="submit"
                class="w-full bg-biblo-charcoal text-white py-5 mt-4 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                Reset Password
            </button>
        </form>

        <p class="text-center text-sm font-medium text-biblo-charcoal/60 mt-8">
            Sudah ingat password?
            <a href="{{ route('login') }}" class="font-extrabold text-biblo-charcoal hover:text-biblo-moss transition-colors">
                Masuk di sini
            </a>
        </p>
    </div>

</body>
</html>
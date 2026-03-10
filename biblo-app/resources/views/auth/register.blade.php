{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Biblo - Mulai Petualangan Literasimu</title>
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
                        'biblo-purple': '#A688CC',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        /* Custom scrollbar untuk form yang panjang */
        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #CFC8BE; border-radius: 10px; }
    </style>
</head>
<body class="bg-biblo-oat min-h-screen flex items-center justify-center p-4 md:p-6">

    <div class="bg-white w-full max-w-7xl min-h-[85vh] rounded-[3rem] overflow-hidden flex flex-col md:flex-row shadow-2xl transition-all duration-300">
        
        <div class="hidden md:flex md:w-[40%] bg-biblo-purple p-10 flex-col items-center justify-center text-center relative overflow-hidden">
            <div class="absolute -top-20 -right-20 w-80 h-80 bg-white/10 rounded-full"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[120%] h-[120%] border border-white/5 rounded-full opacity-20"></div>

            <div class="relative z-10">
                <div class="w-24 h-24 bg-white/20 backdrop-blur-md rounded-3xl flex items-center justify-center text-5xl mx-auto mb-8 shadow-xl">
                    🌱
                </div>
                <h2 class="text-white text-3xl font-extrabold mb-4 leading-tight">Awal Baru <br> Menantimu.</h2>
                <p class="text-white/70 text-sm max-w-[250px] mx-auto leading-relaxed">
                    Daftar sekarang dan biarkan pet digitalmu tumbuh seiring bertambahnya ilmu yang kamu baca.
                </p>
            </div>

            <div class="absolute bottom-10 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-white/30"></div>
                <div class="w-8 h-2 rounded-full bg-white"></div>
                <div class="w-2 h-2 rounded-full bg-white/30"></div>
            </div>
        </div>

        <div class="w-full md:w-[60%] p-8 md:p-12 lg:p-16 flex flex-col justify-center items-center">
            <div class="w-full max-w-md custom-scrollbar">
                
                <div class="flex justify-center md:justify-end mb-8 text-xs font-semibold">
                    <p class="text-biblo-charcoal/50">Already have an account?</p>
                    <a href="#" class="text-biblo-moss font-bold hover:underline ml-1">Sign In</a>
                </div>

                <div class="text-center md:text-left mb-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-biblo-charcoal mb-2">Create Account</h1>
                    <p class="text-biblo-charcoal/60 text-sm">Join the community and start your journey.</p>
                </div>

                <form class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1">Email Address</label>
                        <input type="email" placeholder="example@gmail.com" 
                            class="w-full bg-biblo-oat/40 border border-biblo-greige/30 rounded-2xl px-5 py-3.5 text-sm focus:outline-none focus:border-biblo-moss transition-all font-semibold">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1">Username</label>
                        <input type="text" placeholder="biblo_reader" 
                            class="w-full bg-biblo-oat/40 border border-biblo-greige/30 rounded-2xl px-5 py-3.5 text-sm focus:outline-none focus:border-biblo-moss transition-all font-semibold">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1">Password</label>
                            <input type="password" placeholder="••••••••" 
                                class="w-full bg-biblo-oat/40 border border-biblo-greige/30 rounded-2xl px-5 py-3.5 text-sm focus:outline-none focus:border-biblo-moss transition-all font-semibold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/40 mb-1.5 ml-1">Confirm Password</label>
                            <input type="password" placeholder="••••••••" 
                                class="w-full bg-biblo-oat/40 border border-biblo-greige/30 rounded-2xl px-5 py-3.5 text-sm focus:outline-none focus:border-biblo-moss transition-all font-semibold">
                        </div>
                    </div>

                    <div class="pt-2">
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <div class="relative flex items-center">
                                <input type="checkbox" class="peer h-5 w-5 cursor-pointer appearance-none rounded-lg border-2 border-biblo-greige bg-white checked:bg-biblo-moss checked:border-biblo-moss transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="absolute h-3.5 w-3.5 text-white opacity-0 peer-checked:opacity-100 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-biblo-charcoal/60 leading-snug">
                                I agree to the <a href="#" class="text-biblo-moss hover:underline">Terms of Service</a> and <a href="#" class="text-biblo-moss hover:underline">Privacy Policy</a>.
                            </span>
                        </label>
                    </div>

                    <button type="submit" 
                        class="w-full bg-biblo-charcoal hover:bg-black text-white py-4 rounded-2xl font-extrabold shadow-xl shadow-biblo-charcoal/10 transition-all transform hover:translate-y-[-2px] active:scale-[0.98] mt-4">
                        Create Account
                    </button>
                </form>

                <div class="relative my-8 text-center">
                    <span class="bg-white px-4 text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/20">or sign up with</span>
                    <div class="absolute inset-0 -z-10 flex items-center">
                        <div class="w-full border-t border-biblo-greige/20"></div>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button class="flex-1 flex items-center justify-center py-3 border border-biblo-greige/30 rounded-xl hover:bg-biblo-oat transition-all">
                        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5" alt="Google">
                    </button>
                    <button class="flex-1 flex items-center justify-center py-3 border border-biblo-greige/30 rounded-xl hover:bg-biblo-oat transition-all">
                        <img src="https://www.svgrepo.com/show/330030/apple.svg" class="h-5 w-5" alt="Apple">
                    </button>
                </div>

            </div>
        </div>
    </div>

</body>
</html>
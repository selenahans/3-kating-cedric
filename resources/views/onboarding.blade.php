<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personalisasi Perjalananmu - Biblo</title>
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            overflow: hidden;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    </style>
</head>

<body class="bg-biblo-oat h-screen w-screen flex items-center justify-center p-6 relative">

    <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-biblo-sage/20 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-biblo-purple/20 rounded-full blur-[120px]"></div>

    <div class="glass-card w-full max-w-2xl rounded-[3rem] shadow-2xl p-10 md:p-16 relative z-10">

        <div class="flex justify-center gap-2 mb-12">
            <div id="dot-1" class="h-1.5 w-12 rounded-full bg-biblo-moss transition-all duration-300"></div>
            <div id="dot-2" class="h-1.5 w-4 rounded-full bg-biblo-greige transition-all duration-300"></div>
            <div id="dot-3" class="h-1.5 w-4 rounded-full bg-biblo-greige transition-all duration-300"></div>
        </div>
        <form method="POST" id="onboardingForm" action="{{ route('onboarding.store') }}">
            @csrf

            <div id="step-1" class="step-content active text-center">
                <div class="text-6xl mb-6">🥚</div>
                <h2 class="text-3xl font-extrabold text-biblo-charcoal mb-4">Beri Nama Temanmu</h2>
                <p class="text-biblo-charcoal/50 text-sm mb-8">Telur ini akan menetas menjadi pet yang menemanimu
                    membaca. Siapa namanya?</p>

                <div class="max-w-xs mx-auto">
                    <input id="pet-name-input" type="text" name="pet_name" placeholder="Panggil dia..."
                        class="w-full bg-white border-2 border-gray-100 rounded-2xl px-6 py-4 text-center font-bold focus:outline-none focus:border-biblo-moss transition-all shadow-sm text-lg">
                    <p id="pet-name-error" class="hidden mt-3 text-xs font-bold text-red-500">Nama pet wajib diisi dulu ya.</p>
                </div>

                <button type="button" onclick="nextStep(2)"
                    class="mt-12 bg-biblo-charcoal text-white px-10 py-4 rounded-2xl font-bold shadow-xl hover:bg-black transition-all">
                    Lanjut: Tentukan Target
                </button>
            </div>

            <div id="step-2" class="step-content text-center">
                <div class="text-6xl mb-6">🔥</div>
                <h2 class="text-3xl font-extrabold text-biblo-charcoal mb-4">Target Membaca</h2>
                <p class="text-biblo-charcoal/50 text-sm mb-8">Berapa lembar yang ingin kamu selesaikan setiap harinya?
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <label for="target-5" class="cursor-pointer">
                        <input id="target-5" type="radio" name="target" value="5" class="sr-only peer" checked>
                        <div class="bg-white border-2 border-gray-100 rounded-3xl p-6 transition-all hover:scale-105 peer-checked:border-biblo-moss peer-checked:bg-biblo-moss/10 peer-checked:ring-2 peer-checked:ring-biblo-moss/20 peer-checked:text-biblo-moss">
                            <span class="block text-2xl mb-2">🌤️</span>
                            <span class="block font-bold text-biblo-charcoal">5 Lembar</span>
                            <span class="text-[10px] text-biblo-charcoal/40 font-bold uppercase">Santai</span>
                        </div>
                    </label>
                    <label for="target-15" class="cursor-pointer">
                        <input id="target-15" type="radio" name="target" value="15" class="sr-only peer">
                        <div class="bg-white border-2 border-gray-100 rounded-3xl p-6 transition-all hover:scale-105 peer-checked:border-biblo-moss peer-checked:bg-biblo-moss/10 peer-checked:ring-2 peer-checked:ring-biblo-moss/20 peer-checked:text-biblo-moss">
                            <span class="block text-2xl mb-2">🔥</span>
                            <span class="block font-bold text-biblo-charcoal">15 Lembar</span>
                            <span class="text-[10px] text-biblo-charcoal/40 font-bold uppercase">Sedang</span>
                        </div>
                    </label>
                    <label for="target-30" class="cursor-pointer">
                        <input id="target-30" type="radio" name="target" value="30" class="sr-only peer">
                        <div class="bg-white border-2 border-gray-100 rounded-3xl p-6 transition-all hover:scale-105 peer-checked:border-biblo-moss peer-checked:bg-biblo-moss/10 peer-checked:ring-2 peer-checked:ring-biblo-moss/20 peer-checked:text-biblo-moss">
                            <span class="block text-2xl mb-2">⚡</span>
                            <span class="block font-bold text-biblo-charcoal">30 Lembar</span>
                            <span class="text-[10px] text-biblo-charcoal/40 font-bold uppercase">Ambisius</span>
                        </div>
                    </label>
                </div>

                <div class="flex items-center justify-center gap-4 mt-12">
                    <button type="button" onclick="nextStep(1)"
                        class="text-biblo-charcoal/40 font-bold text-sm hover:text-biblo-charcoal transition">Kembali</button>
                    <button type="button" onclick="nextStep(3)"
                        class="bg-biblo-charcoal text-white px-10 py-4 rounded-2xl font-bold shadow-xl hover:bg-black transition-all">
                        Hampir Selesai
                    </button>
                </div>
            </div>

            <div id="step-3" class="step-content text-center">
                <div class="text-6xl mb-6">📚</div>
                <h2 class="text-3xl font-extrabold text-biblo-charcoal mb-4">Pilih Minatmu</h2>
                <p class="text-biblo-charcoal/50 text-sm mb-8">Genre apa yang paling sering kamu baca?</p>

                <div class="flex flex-wrap justify-center gap-3">
                    {{-- Loop through the categories from the database --}}
                    @foreach($categories as $category)
                        <label class="cursor-pointer group">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="sr-only peer">

                            {{-- Peer classes allow us to change the style when the hidden checkbox is checked --}}
                            <div class="bg-white border-2 border-gray-100 rounded-full px-6 py-3 font-bold text-sm text-biblo-charcoal/60 transition-all 
                            peer-checked:border-biblo-moss peer-checked:bg-biblo-moss/5 peer-checked:text-biblo-moss 
                            hover:border-biblo-moss">
                                {{ $category->name }}
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="flex items-center justify-center gap-4 mt-12">
                    <button type="button" onclick="nextStep(2)"
                        class="text-biblo-charcoal/40 font-bold text-sm hover:text-biblo-charcoal transition">Kembali</button>
                    <button type="submit"
                        class="bg-biblo-moss text-white px-10 py-4 rounded-2xl font-extrabold shadow-xl hover:bg-biblo-charcoal transition-all">
                        Mulai Petualangan!
                    </button>
                </div>
            </div>
    </div>
    </form>
    </div>

    <p
        class="absolute bottom-8 left-0 right-0 text-center text-[10px] font-black text-biblo-charcoal/20 tracking-widest uppercase">
        © 2026 BIBLO INTERACTIVE. SELURUH HAK CIPTA DILINDUNGI.
    </p>

    <script>
        function nextStep(step) {
            const petNameInput = document.getElementById('pet-name-input');
            const petNameError = document.getElementById('pet-name-error');

            if (step === 2 && petNameInput) {
                const nameValue = petNameInput.value.trim();
                if (nameValue.length === 0) {
                    petNameInput.classList.add('border-red-300');
                    petNameInput.classList.remove('border-gray-100');
                    if (petNameError) {
                        petNameError.classList.remove('hidden');
                    }
                    petNameInput.focus();
                    return;
                }

                petNameInput.classList.remove('border-red-300');
                petNameInput.classList.add('border-gray-100');
                if (petNameError) {
                    petNameError.classList.add('hidden');
                }
            }

            // Sembunyikan semua step
            document.querySelectorAll('.step-content').forEach(el => el.classList.remove('active'));
            // Tampilkan step tujuan
            document.getElementById('step-' + step).classList.add('active');

            // Update Progress Dots
            document.querySelectorAll('[id^="dot-"]').forEach((dot, index) => {
                if (index + 1 === step) {
                    dot.classList.replace('w-4', 'w-12');
                    dot.classList.replace('bg-biblo-greige', 'bg-biblo-moss');
                } else {
                    dot.classList.replace('w-12', 'w-4');
                    dot.classList.replace('bg-biblo-moss', 'bg-biblo-greige');
                }
            });
        }
    </script>
</body>

</html>
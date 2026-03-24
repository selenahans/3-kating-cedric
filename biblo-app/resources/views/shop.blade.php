<x-app-layout title="Pet Shop" active="pet">
    <div class="max-w-5xl mx-auto space-y-8 md:space-y-10 pb-20">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                {{-- <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss mb-1">Marketplace</p> --}}
                <h1 class="text-3xl sm:text-4xl font-extrabold text-biblo-charcoal tracking-tighter">{{ $currentPetName ?? 'Pet' }}'s <span class="text-biblo-clay">Shop</span></h1>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <div class="bg-white border border-biblo-greige/30 px-4 sm:px-6 py-3 rounded-2xl shadow-sm flex items-center justify-between gap-3 w-full md:w-auto">
                    <div>
                        <p class="text-[9px] font-black text-biblo-charcoal/40 uppercase tracking-widest leading-none">Your Balance</p>
                        <p class="text-xl font-extrabold text-biblo-charcoal">{{ $currentCoins ?? 0 }} <span class="text-sm font-bold text-biblo-clay">🪙</span></p>
                    </div>
                    <div class="w-[1px] h-8 bg-biblo-greige/20 mx-1"></div>
                    <a href="#" class="w-8 h-8 bg-biblo-sage/10 text-biblo-sage rounded-full flex items-center justify-center hover:bg-biblo-sage hover:text-white transition-all">
                        <span class="font-bold text-lg">+</span>
                    </a>
                </div>
            </div>
        </header>

        <nav class="flex overflow-x-auto pb-2 gap-3 no-scrollbar">
            @php
                $categories = [
                    ['name' => 'Food', 'icon' => '🍎', 'active' => true],
                    ['name' => 'Accessories', 'icon' => '🎀', 'active' => false],
                    ['name' => 'Skins', 'icon' => '🎨', 'active' => false],
                ];
            @endphp

            @foreach($categories as $cat)
                <button class="flex-none px-5 sm:px-8 py-3 rounded-2xl font-black text-[11px] uppercase tracking-widest transition-all border whitespace-nowrap {{ $cat['active'] ? 'bg-biblo-charcoal text-white border-biblo-charcoal shadow-lg shadow-biblo-charcoal/20' : 'bg-white text-biblo-charcoal/60 border-biblo-greige/20 hover:border-biblo-moss hover:text-biblo-moss' }}">
                    <span class="mr-2">{{ $cat['icon'] }}</span> {{ $cat['name'] }}
                </button>
            @endforeach
        </nav>

        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $items = [
                    ['name' => 'Golden Apple', 'price' => 45, 'icon' => '🍎', 'desc' => 'Instantly restores 50% hunger.', 'color' => 'bg-orange-50'],
                    ['name' => 'Royal Honey', 'price' => 80, 'icon' => '🍯', 'desc' => 'Boosts happiness for 2 hours.', 'color' => 'bg-amber-50'],
                    ['name' => 'Magical Berry', 'price' => 120, 'icon' => '🫐', 'desc' => 'Small chance to gain extra EXP.', 'color' => 'bg-indigo-50'],
                    ['name' => 'Crispy Leaf', 'price' => 15, 'icon' => '🌿', 'desc' => 'A light snack for quick energy.', 'color' => 'bg-emerald-50'],
                ];
            @endphp

            @foreach($items as $item)
            <div class="bg-white border border-biblo-greige/20 rounded-[28px] sm:rounded-[40px] p-5 sm:p-6 hover:shadow-2xl hover:shadow-biblo-charcoal/5 transition-all group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 {{ $item['color'] }} rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>

                <div class="relative z-10">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 {{ $item['color'] }} rounded-2xl sm:rounded-3xl flex items-center justify-center text-3xl sm:text-4xl mb-5 sm:mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform">
                        {{ $item['icon'] }}
                    </div>

                    <div class="space-y-1 mb-5 sm:mb-6">
                        <h4 class="font-extrabold text-base sm:text-lg text-biblo-charcoal">{{ $item['name'] }}</h4>
                        <p class="text-xs font-medium text-biblo-charcoal/50 leading-relaxed">
                            {{ $item['desc'] }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-biblo-greige/10">
                        <div class="flex items-center gap-1">
                            <span class="text-sm font-black text-biblo-charcoal">{{ $item['price'] }}</span>
                            <span class="text-xs">🪙</span>
                        </div>
                        
                        <button class="bg-biblo-oat hover:bg-biblo-clay hover:text-white text-biblo-charcoal text-[10px] font-black px-5 py-2.5 rounded-xl transition-all uppercase tracking-widest">
                            Purchase
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

        <footer class="bg-biblo-sage/10 border border-biblo-sage/20 rounded-[28px] sm:rounded-[45px] p-5 sm:p-8 flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-5">
                <div class="text-4xl">✨</div>
                <div>
                    <h4 class="font-extrabold text-biblo-charcoal">Daily Discount</h4>
                    <p class="text-xs font-bold text-biblo-moss/70">Finish 2 more chapters to unlock 20% discount on all skins!</p>
                </div>
            </div>
            <div class="w-full md:w-auto">
                <div class="w-full md:w-48 bg-white/50 h-2 rounded-full overflow-hidden">
                    <div class="bg-biblo-sage h-full rounded-full" style="width: 60%"></div>
                </div>
                <p class="text-[10px] font-black text-biblo-charcoal/40 mt-2 text-center md:text-right uppercase tracking-widest">1/3 Quests Done</p>
            </div>
        </footer>

    </div>
</x-app-layout>
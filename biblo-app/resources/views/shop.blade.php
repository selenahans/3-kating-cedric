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
                    ['name' => 'Food', 'icon' => '🍎', 'id' => 'food'],
                    ['name' => 'Accessories', 'icon' => '🎀', 'id' => 'accessories'],
                    ['name' => 'Skins', 'icon' => '🎨', 'id' => 'skins'],
                ];
            @endphp

            @foreach($categories as $cat)
                <button data-category="{{ $cat['id'] }}" class="category-btn flex-none px-5 sm:px-8 py-3 rounded-2xl font-black text-[11px] uppercase tracking-widest transition-all border whitespace-nowrap {{ $loop->first ? 'bg-biblo-charcoal text-white border-biblo-charcoal shadow-lg shadow-biblo-charcoal/20' : 'bg-white text-biblo-charcoal/60 border-biblo-greige/20 hover:border-biblo-moss hover:text-biblo-moss' }}">
                    <span class="mr-2">{{ $cat['icon'] }}</span> {{ $cat['name'] }}
                </button>
            @endforeach
        </nav>

        {{-- FOOD SECTION --}}
        <section id="food-section" class="category-section grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $foodItems = [
                    ['name' => 'Organic Apple', 'price' => 10, 'icon' => '🍎', 'desc' => 'A fresh apple to restore hunger.', 'color' => 'bg-orange-50'],
                    ['name' => 'Sweet Honey', 'price' => 15, 'icon' => '🍯', 'desc' => 'Golden honey for extra energy.', 'color' => 'bg-amber-50'],
                    ['name' => 'Magical Berry', 'price' => 30, 'icon' => '🫐', 'desc' => 'Mysterious berry with magic energy.', 'color' => 'bg-indigo-50'],
                    ['name' => 'Crispy Leaf', 'price' => 50, 'icon' => '🌿', 'desc' => 'A nutritious leaf for vitality.', 'color' => 'bg-emerald-50'],
                ];
            @endphp

            @foreach($foodItems as $item)
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

        {{-- ACCESSORIES SECTION --}}
        <section id="accessories-section" class="category-section grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" style="display: none;">
            @php
                $accessoriesItems = [
                    ['name' => 'Golden Crown', 'price' => 50, 'icon' => '👑', 'desc' => 'A majestic crown for royalty vibes.', 'color' => 'bg-yellow-50'],
                    ['name' => 'Flower Crown', 'price' => 35, 'icon' => '🌸', 'desc' => 'Delicate flowers for elegance.', 'color' => 'bg-pink-50'],
                    ['name' => 'Sparkly Glasses', 'price' => 40, 'icon' => '✨', 'desc' => 'Glamorous glasses that shine.', 'color' => 'bg-purple-50'],
                    ['name' => 'Rainbow Ribbon', 'price' => 25, 'icon' => '🎀', 'desc' => 'Colorful ribbon for style.', 'color' => 'bg-rose-50'],
                    ['name' => 'Star Hairpin', 'price' => 30, 'icon' => '⭐', 'desc' => 'Sparkle like a star.', 'color' => 'bg-cyan-50'],
                    ['name' => 'Moon Pendant', 'price' => 45, 'icon' => '🌙', 'desc' => 'Sleek moon-shaped pendant.', 'color' => 'bg-indigo-50'],
                ];
            @endphp

            @foreach($accessoriesItems as $item)
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

        {{-- SKINS SECTION --}}
        <section id="skins-section" class="category-section grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" style="display: none;">
            @php
                $skinsItems = [
                    ['name' => 'Classic White', 'price' => 0, 'icon' => '🐦', 'desc' => 'The default, pure white skin.', 'color' => 'bg-slate-50'],
                    ['name' => 'Golden Eagle', 'price' => 100, 'icon' => '🦅', 'desc' => 'Powerful golden eagle appearance.', 'color' => 'bg-yellow-50'],
                    ['name' => 'Sunset Orange', 'price' => 75, 'icon' => '🧡', 'desc' => 'Warm orange sunset vibes.', 'color' => 'bg-orange-50'],
                    ['name' => 'Ocean Blue', 'price' => 80, 'icon' => '🌊', 'desc' => 'Cool blue like the ocean.', 'color' => 'bg-blue-50'],
                    ['name' => 'Forest Green', 'price' => 70, 'icon' => '🌲', 'desc' => 'Natural forest green tone.', 'color' => 'bg-emerald-50'],
                    ['name' => 'Midnight Purple', 'price' => 90, 'icon' => '🌙', 'desc' => 'Mysterious purple darkness.', 'color' => 'bg-purple-50'],
                ];
            @endphp

            @foreach($skinsItems as $item)
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
                            {{ $item['price'] === 0 ? 'Owned' : 'Purchase' }}
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>


    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryBtns = document.querySelectorAll('.category-btn');
            const categorySections = document.querySelectorAll('.category-section');

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const category = this.dataset.category;

                    // Remove active state from all buttons
                    categoryBtns.forEach(b => {
                        b.classList.remove('bg-biblo-charcoal', 'text-white', 'border-biblo-charcoal', 'shadow-lg', 'shadow-biblo-charcoal/20');
                        b.classList.add('bg-white', 'text-biblo-charcoal/60', 'border-biblo-greige/20');
                    });

                    // Add active state to clicked button
                    this.classList.remove('bg-white', 'text-biblo-charcoal/60', 'border-biblo-greige/20');
                    this.classList.add('bg-biblo-charcoal', 'text-white', 'border-biblo-charcoal', 'shadow-lg', 'shadow-biblo-charcoal/20');

                    // Hide all sections
                    categorySections.forEach(section => {
                        section.style.display = 'none';
                    });

                    // Show selected section
                    const selectedSection = document.getElementById(category + '-section');
                    if (selectedSection) {
                        selectedSection.style.display = '';
                    }
                });
            });
        });
    </script>
</x-app-layout>
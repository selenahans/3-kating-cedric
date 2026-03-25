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
                        
                        <button class="purchase-btn bg-biblo-oat hover:bg-biblo-clay hover:text-white text-biblo-charcoal text-[10px] font-black px-5 py-2.5 rounded-xl transition-all uppercase tracking-widest" data-item-name="{{ $item['name'] }}" data-item-price="{{ $item['price'] }}">
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
                        
                        <button class="purchase-btn bg-biblo-oat hover:bg-biblo-clay hover:text-white text-biblo-charcoal text-[10px] font-black px-5 py-2.5 rounded-xl transition-all uppercase tracking-widest" data-item-name="{{ $item['name'] }}" data-item-price="{{ $item['price'] }}">
                            Purchase
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

        {{-- SKINS SECTION --}}
        <section id="skins-section" class="category-section grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" style="display: none;">
            @foreach($skinsItems as $item)
            <div class="bg-white border border-biblo-greige/20 rounded-[28px] sm:rounded-[40px] p-5 sm:p-6 hover:shadow-2xl hover:shadow-biblo-charcoal/5 transition-all group relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 {{ $item['color'] }} rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-700"></div>

                <div class="relative z-10">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 {{ $item['color'] }} rounded-2xl sm:rounded-3xl flex items-center justify-center mb-5 sm:mb-6 group-hover:scale-110 group-hover:rotate-3 transition-transform overflow-hidden">
                        <img src="{{ asset($item['image_path']) }}" alt="{{ $item['name'] }} skin" class="w-full h-full object-cover">
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

                        @if(!empty($item['equipped']))
                            <button class="bg-biblo-moss/20 text-biblo-moss text-[10px] font-black px-5 py-2.5 rounded-xl cursor-default uppercase tracking-widest">
                                Equipped
                            </button>
                        @elseif(!empty($item['owned']))
                            <button class="equip-skin-btn bg-biblo-charcoal hover:bg-biblo-moss text-white text-[10px] font-black px-5 py-2.5 rounded-xl transition-all uppercase tracking-widest" data-item-name="{{ $item['name'] }}">
                                Equip
                            </button>
                        @else
                            <button class="purchase-btn bg-biblo-oat hover:bg-biblo-clay hover:text-white text-biblo-charcoal text-[10px] font-black px-5 py-2.5 rounded-xl transition-all uppercase tracking-widest" data-item-name="{{ $item['name'] }}" data-item-price="{{ $item['price'] }}">
                                Purchase
                            </button>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </section>


    </div>

    {{-- Purchase Confirmation Modal --}}
    <div id="purchase-modal"
        class="fixed inset-0 z-[99] bg-biblo-charcoal/30 backdrop-blur-sm hidden items-center justify-center px-4">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl transform transition-all">
            <h3 class="font-extrabold text-2xl text-biblo-charcoal mb-2" id="modal-item-name">Item</h3>
            <p class="text-biblo-charcoal/60 mb-6 text-sm">Apakah kamu yakin ingin membeli item ini?</p>
            
            <div class="bg-biblo-oat/20 rounded-2xl p-4 mb-6 flex items-center justify-between">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-1">Harga</p>
                    <p class="text-2xl font-extrabold text-biblo-charcoal" id="modal-item-price">0 🪙</p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest text-biblo-charcoal/60 mb-1">Saldo Koin</p>
                    <p class="text-2xl font-extrabold text-biblo-sage" id="modal-current-coins">0 🪙</p>
                </div>
            </div>

            <p id="modal-error-message" class="text-red-500 text-sm font-bold mb-4 hidden"></p>

            <div class="flex gap-3">
                <button id="purchase-cancel-btn"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-biblo-charcoal bg-biblo-greige/20 hover:bg-biblo-greige/40 transition-all">
                    Batal
                </button>
                <button id="purchase-confirm-btn"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-white bg-biblo-moss hover:bg-[#7e8f7a] transition-all">
                    Ya, Beli
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoryBtns = document.querySelectorAll('.category-btn');
            const categorySections = document.querySelectorAll('.category-section');
            const purchaseModal = document.getElementById('purchase-modal');
            const purchaseCancelBtn = document.getElementById('purchase-cancel-btn');
            const purchaseConfirmBtn = document.getElementById('purchase-confirm-btn');
            const modalItemName = document.getElementById('modal-item-name');
            const modalItemPrice = document.getElementById('modal-item-price');
            const modalCurrentCoins = document.getElementById('modal-current-coins');
            const modalErrorMessage = document.getElementById('modal-error-message');
            const yourBalanceEl = document.querySelector('.text-xl.font-extrabold.text-biblo-charcoal');

            let pendingPurchase = null;

            const bindEquipHandlers = () => {
                document.querySelectorAll('.equip-skin-btn').forEach(btn => {
                    btn.addEventListener('click', async function(e) {
                        e.preventDefault();
                        const itemName = this.dataset.itemName;

                        try {
                            const response = await fetch("{{ route('shop.equip-skin') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document
                                        .querySelector('meta[name="csrf-token"]')
                                        .getAttribute('content')
                                },
                                body: JSON.stringify({ item_name: itemName })
                            });

                            const data = await response.json();
                            if (!response.ok || !data.success) {
                                alert(data.message || 'Gagal equip skin.');
                                return;
                            }

                            window.location.reload();
                        } catch (error) {
                            console.error('Equip skin error:', error);
                            alert('Terjadi kesalahan saat equip skin.');
                        }
                    });
                });
            };

            // Tab switching
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const category = this.dataset.category;

                    categoryBtns.forEach(b => {
                        b.classList.remove('bg-biblo-charcoal', 'text-white', 'border-biblo-charcoal', 'shadow-lg', 'shadow-biblo-charcoal/20');
                        b.classList.add('bg-white', 'text-biblo-charcoal/60', 'border-biblo-greige/20');
                    });

                    this.classList.remove('bg-white', 'text-biblo-charcoal/60', 'border-biblo-greige/20');
                    this.classList.add('bg-biblo-charcoal', 'text-white', 'border-biblo-charcoal', 'shadow-lg', 'shadow-biblo-charcoal/20');

                    categorySections.forEach(section => {
                        section.style.display = 'none';
                    });

                    const selectedSection = document.getElementById(category + '-section');
                    if (selectedSection) {
                        selectedSection.style.display = '';
                    }
                });
            });

            // Purchase button handling
            const purchaseButtons = document.querySelectorAll('.purchase-btn');
            
            purchaseButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const itemName = this.dataset.itemName;
                    const itemPrice = parseInt(this.dataset.itemPrice);
                    const currentCoinsText = yourBalanceEl?.textContent || '0';
                    const currentCoins = parseInt(currentCoinsText.match(/\d+/)?.[0] || 0);

                    pendingPurchase = {
                        itemName: itemName,
                        itemPrice: itemPrice
                    };

                    modalItemName.textContent = itemName;
                    modalItemPrice.textContent = itemPrice + ' 🪙';
                    modalCurrentCoins.textContent = currentCoins + ' 🪙';
                    modalErrorMessage.classList.add('hidden');
                    modalErrorMessage.textContent = '';

                    purchaseModal.classList.remove('hidden');
                    purchaseModal.classList.add('flex');
                });
            });

            // Cancel purchase
            purchaseCancelBtn.addEventListener('click', function() {
                purchaseModal.classList.add('hidden');
                purchaseModal.classList.remove('flex');
                pendingPurchase = null;
                modalErrorMessage.classList.add('hidden');
            });

            // Confirm purchase
            purchaseConfirmBtn.addEventListener('click', async function() {
                if (!pendingPurchase) return;

                const itemName = pendingPurchase.itemName;

                try {
                    // Get item ID from database by name
                    const response = await fetch("{{ route('shop.purchase') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            item_name: itemName
                        })
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        modalErrorMessage.textContent = data.message || 'Pembelian gagal.';
                        modalErrorMessage.classList.remove('hidden');
                        return;
                    }

                    // Update coin balance
                    if (yourBalanceEl) {
                        const newCoins = data.coins;
                        yourBalanceEl.innerHTML = newCoins + ' <span class="text-sm font-bold text-biblo-clay">🪙</span>';
                    }

                    // Show success and close modal after 1 second
                    modalItemName.textContent = '✅ Berhasil dibeli!';
                    purchaseConfirmBtn.disabled = true;
                    purchaseCancelBtn.disabled = true;

                    setTimeout(() => {
                        if (data.item_type === 'skin') {
                            window.location.reload();
                            return;
                        }

                        purchaseModal.classList.add('hidden');
                        purchaseModal.classList.remove('flex');
                        pendingPurchase = null;
                        purchaseConfirmBtn.disabled = false;
                        purchaseCancelBtn.disabled = false;
                    }, 1500);

                } catch (error) {
                    console.error('Purchase error:', error);
                    modalErrorMessage.textContent = 'Terjadi kesalahan. Coba lagi.';
                    modalErrorMessage.classList.remove('hidden');
                }
            });

            bindEquipHandlers();
        });
    </script>
</x-app-layout>
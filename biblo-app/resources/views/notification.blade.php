<x-app-layout>
    <div class="max-w-4xl mx-auto space-y-8">
        
        <section class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tight text-biblo-charcoal">Notifikasi</h1>
                <p class="text-biblo-charcoal/50 text-sm mt-1">Pantau aktivitas terbaru dan pembaruan buku favoritmu.</p>
            </div>
            
            <div class="flex gap-2">
                <button class="bg-biblo-charcoal text-white px-5 py-2 rounded-full text-xs font-bold hover:bg-biblo-charcoal/90 transition-all">
                    Tandai Semua Dibaca
                </button>
                <button class="bg-white text-biblo-charcoal border border-biblo-greige/30 p-2 rounded-full hover:bg-biblo-oat transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                </button>
            </div>
        </section>

        <div class="space-y-4">
            @php
                $notifications = [
                    [
                        'type' => 'promo',
                        'title' => 'Diskon Akhir Pekan!',
                        'desc' => 'Dapatkan potongan 50% untuk semua genre Psychology. Hanya sampai hari Minggu!',
                        'time' => '2 jam yang lalu',
                        'unread' => true,
                        'icon' => '🏷️'
                    ],
                    [
                        'type' => 'update',
                        'title' => 'Buku Baru Tersedia',
                        'desc' => 'Buku "Beyond Good and Evil" karya Friedrich Nietzsche kini sudah bisa kamu baca.',
                        'time' => '5 jam yang lalu',
                        'unread' => true,
                        'icon' => '📖'
                    ],
                    [
                        'type' => 'social',
                        'title' => 'Seseorang menyukai ulasanmu',
                        'desc' => 'Review kamu di buku "Atomic Habits" mendapatkan 12 suka baru.',
                        'time' => '1 hari yang lalu',
                        'unread' => false,
                        'icon' => '✨'
                    ],
                    [
                        'type' => 'reminder',
                        'title' => 'Lanjutkan Membaca',
                        'desc' => 'Kamu belum menyelesaikan "The Psychology of Money". Tinggal 2 bab lagi!',
                        'time' => '2 hari yang lalu',
                        'unread' => false,
                        'icon' => '⏳'
                    ]
                ];
            @endphp

            @foreach($notifications as $notif)
            <div class="group relative bg-white border {{ $notif['unread'] ? 'border-biblo-moss/30 shadow-sm' : 'border-biblo-greige/10' }} rounded-[2.5rem] p-6 transition-all hover:shadow-md cursor-pointer">
                <div class="flex gap-5 items-start">
                    <div class="flex-shrink-0 w-12 h-12 {{ $notif['unread'] ? 'bg-biblo-moss/10' : 'bg-biblo-greige/20' }} rounded-2xl flex items-center justify-center text-xl">
                        {{ $notif['icon'] }}
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h4 class="font-bold text-biblo-charcoal {{ $notif['unread'] ? 'text-base' : 'text-sm' }}">
                                {{ $notif['title'] }}
                            </h4>
                            <span class="text-[10px] font-medium text-biblo-charcoal/30 uppercase tracking-wider">{{ $notif['time'] }}</span>
                        </div>
                        <p class="text-sm text-biblo-charcoal/60 leading-relaxed">
                            {{ $notif['desc'] }}
                        </p>
                    </div>

                    @if($notif['unread'])
                    <div class="absolute right-6 top-1/2 -translate-y-1/2">
                        <div class="w-2.5 h-2.5 bg-biblo-moss rounded-full shadow-[0_0_10px_rgba(var(--biblo-moss-rgb),0.5)]"></div>
                    </div>
                    @endif
                </div>

                <div class="absolute inset-y-0 right-10 flex items-center opacity-0 group-hover:opacity-100 transition-opacity">
                    <button class="p-2 text-biblo-charcoal/20 hover:text-red-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path></svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>

        <section class="mt-12 p-10 bg-biblo-greige/20 rounded-[40px] border border-dashed border-biblo-greige/40">
            <div class="text-center">
                <h3 class="font-bold text-biblo-charcoal">Ingin pemberitahuan lebih spesifik?</h3>
                <p class="text-sm text-biblo-charcoal/50 mb-6">Atur preferensi genre favoritmu agar kami tahu apa yang harus dikirim.</p>
                <a href="#" class="inline-block bg-biblo-moss text-white px-8 py-3 rounded-full text-xs font-bold tracking-widest uppercase hover:scale-105 transition-transform">
                    Buka Pengaturan
                </a>
            </div>
        </section>

    </div>
</x-app-layout>
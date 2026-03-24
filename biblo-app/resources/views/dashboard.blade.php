<x-app-layout title="Dashboard" active="home">
    {{-- Wrapper utama yang sudah fix alignment-nya --}}
    <div class="w-full space-y-8 md:space-y-10 lg:space-y-12">

        {{-- TOP STATS HEADER --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div
                class="lg:col-span-2 bg-biblo-charcoal rounded-[28px] sm:rounded-[32px] lg:rounded-[40px] p-5 sm:p-6 lg:p-8 text-white relative overflow-hidden flex flex-col justify-between min-h-[220px] sm:min-h-[240px]">
                <div class="relative z-10">
                    <h1 class="text-2xl sm:text-3xl font-extrabold mb-2">Selamat Pagi,
                        {{ Auth::user()->name ?? 'sel' }}! 👋
                    </h1>
                    <p class="text-biblo-greige/60 text-sm">{{ $currentPetName ?? 'Barnaby' }} sedang menunggumu untuk membacakan cerita baru.</p>
                </div>

                <div class="relative z-10 flex flex-wrap gap-4 mt-6">
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 flex items-center gap-3 border border-white/5 w-full sm:w-auto">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">Day
                                Streak</p>
                            <p class="text-xl font-bold">12 Hari</p>
                        </div>
                    </div>
                    <div
                        class="bg-white/10 backdrop-blur-md rounded-2xl p-3 sm:p-4 flex items-center gap-3 border border-white/5 w-full sm:w-auto">
                        {{-- Container Ikon Gambar --}}
                        <div class="w-8 h-8 flex-shrink-0">
                            <img src="{{ asset('images/boo-pet.webp') }}" alt="Pet Icon"
                                class="w-full h-full object-contain">
                        </div>

                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">
                                Pet Status
                            </p>
                            <p class="text-xl font-bold">{{ $currentPetName ?? 'Barnaby' }} (Lv. {{ $petLevel ?? 1 }})</p>
                        </div>
                    </div>
                </div>
                <div
                    class="absolute right-0 bottom-[-20px] w-40 md:w-60 opacity-20 select-none pointer-events-none z-0">
                    <img src="{{ asset('images/boo-pet.webp') }}" alt="{{ $currentPetName ?? 'Pet' }} Mascot"
                        class="w-full h-auto object-contain">
                </div>
            </div>

            {{-- Target Hari Ini --}}
            <div
                class="bg-white rounded-[28px] sm:rounded-[32px] lg:rounded-[40px] p-5 sm:p-6 lg:p-8 shadow-sm flex flex-col justify-between border border-biblo-greige/10">
                <div>
                    <h3 class="font-bold text-lg mb-4 text-biblo-charcoal">Target Hari Ini</h3>
                    <div class="flex items-end gap-2 mb-2">
                        <span class="text-4xl font-extrabold text-biblo-moss">12</span>
                        <span class="text-biblo-charcoal/40 font-bold mb-1">/ 15 Lembar</span>
                    </div>
                    <div class="w-full bg-biblo-oat rounded-full h-2.5">
                        <div class="bg-biblo-moss h-2.5 rounded-full" style="width: 80%"></div>
                    </div>
                </div>
                <p class="text-[11px] font-bold text-biblo-charcoal/40 italic mt-4">3 lembar lagi untuk memberi makan
                    {{ $currentPetName ?? 'Barnaby' }}!</p>
            </div>
        </div>

        {{-- TASK HARI INI --}}
        <div class="w-full overflow-hidden">
            <h3 class="text-lg font-bold mb-6 text-biblo-charcoal">Task Hari Ini</h3>
            <div class="flex gap-6 overflow-x-auto no-scrollbar pb-4">
                @foreach($tasks as $task)
                    <div
                        class="min-w-[260px] sm:min-w-[290px] md:min-w-[320px] min-h-[250px] bg-white rounded-[24px] sm:rounded-[30px] p-4 sm:p-6 shadow-sm border border-biblo-greige/10 flex flex-col justify-between flex-shrink-0">
                        <div>
                            <h4 class="font-bold text-biblo-charcoal">{{ $task->title }}</h4>
                            <p class="text-xs text-biblo-charcoal/40 mt-2 line-clamp-2">{{ $task->description }}</p>
                        </div>

                        <div>
                            <div class="w-full bg-biblo-oat rounded-full h-1.5 mt-2">
                                <div class="bg-biblo-moss h-full rounded-full transition-all duration-700"
                                    style="width: {{ ($task->percentage ?? 0) . '%' }}"></div>
                            </div>
                            <div class="flex justify-between text-[10px] font-bold mt-2 uppercase tracking-widest">
                                <span class="text-biblo-charcoal/40">Progress</span>
                                <span class="text-biblo-moss">{{ round($task->percentage) }}%</span>
                            </div>
                            {{-- Tambahkan kembali Coin & XP Reward --}}
                            <p class="text-[10px] font-bold text-biblo-charcoal/30 mt-1 uppercase tracking-tighter">
                                +{{ $task->coin_reward }} coin • +{{ $task->xp_reward }} XP
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- GRID UTAMA --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            {{-- Recap --}}
            <div
                class="lg:col-span-4 bg-white rounded-[28px] sm:rounded-[32px] lg:rounded-[40px] p-5 sm:p-6 lg:p-8 shadow-sm border border-biblo-greige/10">
                <h3 class="font-bold text-lg mb-6">Recap Februari</h3>
                <div class="space-y-4 text-biblo-charcoal">
                    <div class="flex justify-between items-center bg-biblo-oat/30 p-4 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <span class="text-biblo-purple">📚</span>
                            <span class="text-sm font-bold">Buku Selesai</span>
                        </div>
                        <span class="font-extrabold text-lg">4</span>
                    </div>
                    <div class="flex justify-between items-center bg-biblo-oat/30 p-4 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <span class="text-biblo-sage">📄</span>
                            <span class="text-sm font-bold">Total Halaman</span>
                        </div>
                        <span class="font-extrabold text-lg">482</span>
                    </div>
                    <div class="flex justify-between items-center bg-biblo-oat/30 p-4 rounded-2xl">
                        <div class="flex items-center gap-3">
                            <span class="text-biblo-clay">✨</span>
                            <span class="text-sm font-bold">Poin Didapat</span>
                        </div>
                        <span class="font-extrabold text-lg">1.250</span>
                    </div>
                </div>

                {{-- Tambahkan kembali Grafik Bar Recap --}}
                <div class="mt-8 h-32 w-full bg-biblo-oat/50 rounded-2xl flex items-end justify-between p-4 gap-2">
                    <div class="w-full bg-biblo-greige/30 h-[40%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[70%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-moss h-[90%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[50%] rounded-t-lg"></div>
                </div>
            </div>

            {{-- Continue Reading --}}
            <div
                class="lg:col-span-8 bg-white rounded-[28px] sm:rounded-[32px] lg:rounded-[40px] p-5 sm:p-6 lg:p-8 shadow-sm border border-biblo-greige/10">
                <div class="flex flex-wrap justify-between items-center gap-3 mb-6">
                    <h3 class="font-bold text-lg text-biblo-charcoal">Lanjutkan Membaca</h3>
                    <a href="{{ route('mylibrary') }}"
                        class="text-xs font-bold text-biblo-moss hover:underline uppercase tracking-widest">Lihat
                        Semua</a>
                </div>

                @if(isset($currentBook))
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-8">
                        <div class="w-32 h-44 bg-biblo-greige rounded-[2rem] flex-shrink-0 overflow-hidden shadow-lg">
                            <img src="{{ asset($currentBook->cover_image) }}"
                                onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'"
                                class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1 w-full text-center md:text-left">
                            <span
                                class="text-[10px] font-black text-biblo-moss uppercase tracking-widest">{{ $currentBook->category->name ?? 'Book' }}</span>
                            <h4 class="text-2xl font-extrabold text-biblo-charcoal mt-1">{{ $currentBook->title }}</h4>
                            <p class="text-sm text-biblo-charcoal/50 mb-6">{{ $currentBook->author }}</p>

                            {{-- Progress bar detail --}}
                            @php
                                $progress = $currentProgress->progress_percentage ?? 0;
                            @endphp

                            <div class="space-y-2 mb-8">
                                <div class="flex justify-between text-[11px] font-bold">
                                    <span class="text-biblo-charcoal/40">Progress Baca</span>
                                    <span>{{ $progress }}%</span>
                                </div>
                                <div class="w-full bg-biblo-oat rounded-full h-1.5">
                                    <div class="bg-biblo-charcoal h-1.5 rounded-full" style="width: {{ $progress }}%">
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('book.detail', $currentBook) }}"
                                class="inline-block bg-biblo-moss text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-biblo-charcoal transition-all shadow-lg shadow-biblo-moss/10">
                                Baca Sekarang
                            </a>
                        </div>
                    </div>
                @else
                    <div class="flex items-center justify-center h-44">
                        <p class="text-biblo-charcoal/30 font-bold italic">Belum ada buku yang sedang dibaca.</p>
                    </div>
                @endif
            </div>

        </div>
        {{-- DYNAMIC RECOMMENDATIONS GRID --}}
        <section class="w-full">
            <div class="flex flex-wrap items-center justify-between gap-3 mb-6 px-1 sm:px-2">
                <h3 class="font-bold text-xl text-biblo-charcoal">Recommended For You</h3>
                <a href="{{ route('explore') }}"
                    class="text-xs font-black text-biblo-moss uppercase tracking-widest hover:underline">See All</a>
            </div>

            {{-- Grid System: 2 kolom di HP, 4 kolom di Desktop --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6 lg:gap-8">
                @foreach($books as $book)
                    {{-- Batasan Maksimal 4 Buku --}}
                    @if($loop->iteration > 4)
                        @break
                    @endif

                    <a href="{{ route('book.detail', $book) }}" class="group cursor-pointer block">
                        {{-- Container Cover dengan Radius Besar sesuai Gambar --}}
                        <div
                            class="aspect-[3/4] bg-biblo-greige rounded-[1.5rem] sm:rounded-[2rem] lg:rounded-[2.5rem] mb-3 sm:mb-4 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 relative border border-biblo-greige/10">

                            <img src="{{ asset($book->cover_image) }}"
                                onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                alt="{{ $book->title }}">

                            {{-- Overlay Bookmark saat Hover --}}
                            <div
                                class="absolute top-4 right-4 bg-white/90 backdrop-blur-md p-2 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity shadow-sm">
                                <span class="text-xs">🔖</span>
                            </div>

                            {{-- Rating Badge (Opsional, agar mirip UI Dashboard sebelumnya) --}}
                            <div class="absolute bottom-4 left-4">
                                <span
                                    class="bg-black/20 backdrop-blur-md px-3 py-1 rounded-full text-[10px] font-bold text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                    ⭐ {{ $book->rating ?? '4.8' }}
                                </span>
                            </div>
                        </div>

                        {{-- Info Buku menggunakan variabel lamamu --}}
                        <div class="px-2">
                            <span class="text-[9px] font-black text-biblo-moss uppercase tracking-tighter block mb-1">
                                {{ $book->category->name ?? 'Pilihan Biblo' }}
                            </span>
                            <h5 class="font-bold text-sm text-biblo-charcoal truncate" title="{{ $book->title }}">
                                {{ $book->title }}
                            </h5>
                            <p class="text-xs text-biblo-charcoal/40 mt-1 truncate">
                                {{ $book->author }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
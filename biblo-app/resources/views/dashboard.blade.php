<x-app-layout title="Dashboard" active="home">
    <div class="max-w-7xl mx-auto space-y-8">
        
        {{-- TOP STATS HEADER --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-biblo-charcoal rounded-[40px] p-8 text-white relative overflow-hidden flex flex-col justify-between min-h-[240px]">
                <div class="relative z-10">
                    {{-- Ditambahkan ?? 'Kak' supaya tidak error saat logout --}}
                    <h1 class="text-3xl font-extrabold mb-2">Selamat Pagi, {{ Auth::user()->name ?? 'Kak' }}! 👋</h1>
                    <p class="text-biblo-greige/60 text-sm">Barnaby sedang menunggumu untuk membacakan cerita baru.</p>
                </div>
                
                <div class="relative z-10 flex items-center gap-6 mt-6">
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center gap-3">
                        <span class="text-2xl">🔥</span>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">Day Streak</p>
                            <p class="text-xl font-bold">12 Hari</p>
                        </div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 flex items-center gap-3">
                        <span class="text-2xl">🦉</span>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-white/40 leading-none">Pet Status</p>
                            <p class="text-xl font-bold">Barnaby (Lv. 4)</p>
                        </div>
                    </div>
                </div>

                <div class="absolute right-8 bottom-[-20px] text-[160px] opacity-20 md:opacity-100 select-none">🦉</div>
            </div>

            <div class="bg-white rounded-[40px] p-8 shadow-xl shadow-biblo-greige/20 flex flex-col justify-between border border-white">
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
                <p class="text-[11px] font-bold text-biblo-charcoal/40 italic">3 lembar lagi untuk memberi makan Barnaby!</p>
            </div>
        </div>

        <!-- task list -->
        <h3 class="text-lg font-semibold mb-4">Task Hari Ini</h3>

        <div class="flex gap-4 overflow-x-auto">

            @foreach($tasks as $task)
                <div class="min-w-[320px] h-[260px] bg-white rounded-xl p-4 flex-shrink-0 shadow-sm flex flex-col justify-between">

                    <div>
                        <h4 class="font-semibold">{{ $task->title }}</h4>

                        <div class="text-xs text-gray-400 mt-1 line-clamp-2">
                            {{ $task->description }}
                        </div>
                    </div>

                    {{-- Progress Bar --}}
                    <div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-2">
                            <div 
                                class="bg-green-500 h-full rounded-full transition-all duration-700"
                                style="width: {{ ($task->percentage ?? 0) . '%' }}">
                            </div>
                        </div>

                        <div class="flex justify-between text-xs text-gray-500 mt-1">
                            <span>Progress</span>
                            <span>{{ round($task->percentage) }}%</span>
                        </div>

                        <p class="text-xs text-gray-400 mt-1">
                            +{{ $task->coin_reward }} coin • +{{ $task->xp_reward }} XP
                        </p>
                    </div>

                </div>
            @endforeach

        </div>

        {{-- MAIN CONTENT GRID --}}
        <div class="grid md:grid-cols-12 gap-6">
            
            {{-- RECAP SECTION --}}
            <div class="md:col-span-4 bg-white rounded-[40px] p-8 shadow-xl border border-white">
                <h3 class="font-bold text-lg mb-6">Recap Februari</h3>
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-purple/10 rounded-xl flex items-center justify-center text-biblo-purple">📚</div>
                            <p class="text-sm font-bold">Buku Selesai</p>
                        </div>
                        <span class="font-extrabold text-lg">4</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-sage/10 rounded-xl flex items-center justify-center text-biblo-sage">📄</div>
                            <p class="text-sm font-bold">Total Halaman</p>
                        </div>
                        <span class="font-extrabold text-lg">482</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-biblo-clay/10 rounded-xl flex items-center justify-center text-biblo-clay">✨</div>
                            <p class="text-sm font-bold">Poin Didapat</p>
                        </div>
                        <span class="font-extrabold text-lg">1.250</span>
                    </div>
                </div>
                
                <div class="mt-8 h-32 w-full bg-biblo-oat/50 rounded-2xl flex items-end justify-between p-4 gap-2">
                    <div class="w-full bg-biblo-greige/30 h-[40%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[70%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-moss h-[90%] rounded-t-lg"></div>
                    <div class="w-full bg-biblo-greige/30 h-[50%] rounded-t-lg"></div>
                </div>
            </div>

            {{-- DYNAMIC CONTINUE READING --}}
            <div class="md:col-span-8 space-y-6">
                <div class="flex justify-between items-center px-2">
                    <h3 class="font-bold text-lg">Lanjutkan Membaca</h3>
                    <a href="{{ route('mylibrary') }}" class="text-xs font-bold text-biblo-moss hover:underline">Lihat Semua</a>
                </div>
                
                @if(isset($currentBook))
                <div class="bg-white rounded-[40px] p-6 shadow-xl border border-white flex flex-col md:flex-row gap-6 items-center">
                    <div class="w-32 h-44 bg-biblo-greige rounded-2xl shadow-lg flex-shrink-0 overflow-hidden">
                        <img src="{{ asset($currentBook->cover_image) }}" onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'" class="w-full h-full object-cover" alt="{{ $currentBook->title }}">
                    </div>
                    <div class="flex-1 w-full">
                        <span class="text-[10px] font-black text-biblo-moss uppercase tracking-widest">{{ $currentBook->category->name ?? 'Book' }}</span>
                        <h4 class="text-xl font-extrabold text-biblo-charcoal mt-1">{{ $currentBook->title }}</h4>
                        <p class="text-sm text-biblo-charcoal/50 mb-4">{{ $currentBook->author }}</p>
                        
                        <div class="space-y-2 mb-6">
                            <div class="flex justify-between text-[11px] font-bold">
                                <span>Progress Baca</span>
                                <span>0%</span>
                            </div>
                            <div class="w-full bg-biblo-oat rounded-full h-1.5">
                                <div class="bg-biblo-charcoal h-1.5 rounded-full" style="width: 5%"></div>
                            </div>
                        </div>
                        
                        <a href="{{ route('book.detail', $currentBook->id) }}" class="inline-block bg-biblo-moss text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-biblo-charcoal transition-all">
                            Baca Sekarang
                        </a>
                    </div>
                </div>
                @else
                <div class="bg-white rounded-[40px] p-6 shadow-xl border border-white flex items-center justify-center h-44">
                    <p class="text-biblo-charcoal/50 font-medium">Belum ada buku yang sedang dibaca.</p>
                </div>
                @endif
            </div>
        </div>



        {{-- DYNAMIC RECOMMENDATIONS --}}
        <div class="space-y-6">
            <h3 class="font-bold text-lg px-2">Rekomendasi Untukmu</h3>
            <div class="flex overflow-x-auto gap-6 pb-6 custom-scrollbar">
                
                @foreach($books as $book)
                <a href="{{ route('book.detail', $book->id) }}" class="w-48 flex-shrink-0 group cursor-pointer block">
                    <div class="w-full aspect-[3/4] bg-biblo-greige rounded-[30px] mb-4 overflow-hidden relative shadow-md group-hover:shadow-xl transition-all">
                        <img src="{{ asset($book->cover_image) }}" onerror="this.src='https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2112&auto=format&fit=crop'" class="w-full h-full object-cover" alt="{{ $book->title }}">
                        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
                    </div>
                    <h5 class="font-bold text-sm text-biblo-charcoal truncate" title="{{ $book->title }}">{{ $book->title }}</h5>
                    <p class="text-xs text-biblo-charcoal/40 truncate">{{ $book->author }}</p>
                </a>
                @endforeach
                
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout title="My Library" active="library">
    <div class="space-y-8 md:space-y-10 lg:space-y-12">

        {{-- TOP STATS SECTION --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div
                class="bg-biblo-charcoal rounded-[28px] sm:rounded-[36px] lg:rounded-[45px] p-5 sm:p-6 lg:p-8 text-white relative overflow-hidden shadow-2xl shadow-biblo-charcoal/20 group">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-sage mb-2">My Collection</p>
                    {{-- Dynamically inject the total book count --}}
                    <h2 class="text-4xl sm:text-5xl font-extrabold tracking-tighter">{{ $totalBooks }} <span
                            class="text-xs sm:text-sm font-bold text-biblo-greige/60 ml-2 uppercase">Books</span></h2>
                </div>
                <div class="absolute -right-6 -bottom-6 text-9xl opacity-10 group-hover:scale-110 transition-transform">
                    📚</div>
            </div>

            <div
                class="bg-white rounded-[28px] sm:rounded-[36px] lg:rounded-[45px] p-5 sm:p-6 lg:p-8 border border-biblo-greige/30 shadow-sm flex items-center justify-between group hover:border-biblo-sage transition-all">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/40 mb-2">On Progress
                    </p>
                    <h2 class="text-4xl font-extrabold text-biblo-charcoal">{{ $onProgressCount }}</h2>
                </div>
                <div
                    class="w-16 h-16 bg-biblo-sage/20 rounded-[2rem] flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">
                    ⌛</div>
            </div>

            <div
                class="bg-white rounded-[28px] sm:rounded-[36px] lg:rounded-[45px] p-5 sm:p-6 lg:p-8 border border-biblo-greige/30 shadow-sm flex items-center justify-between group hover:border-biblo-moss transition-all">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/40 mb-2">Completed
                    </p>
                    <h2 class="text-4xl font-extrabold text-biblo-charcoal">{{ $completedCount }}</h2>
                </div>
                <div
                    class="w-16 h-16 bg-biblo-moss/20 rounded-[2rem] flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">
                    ✅</div>
            </div>
        </section>

        {{-- FILTER SECTION --}}
        <section class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div
                class="flex items-center gap-1 bg-biblo-oat p-1.5 rounded-3xl border border-biblo-greige/20 shadow-sm overflow-x-auto no-scrollbar w-full md:w-auto">
                <a href="{{ route('mylibrary', array_filter(['view' => 'books', 'status' => null, 'q' => $search ?: null, 'sort' => $sort ?: null])) }}"
                    class="{{ $view === 'books' && empty($status) ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }} px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold transition-all whitespace-nowrap">
                    All Books
                </a>
                <a href="{{ route('mylibrary', array_filter(['view' => 'books', 'status' => 'reading', 'q' => $search ?: null, 'sort' => $sort ?: null])) }}"
                    class="{{ $view === 'books' && $status === 'reading' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }} px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold transition-all whitespace-nowrap">
                    Reading
                </a>
                <a href="{{ route('mylibrary', array_filter(['view' => 'books', 'status' => 'completed', 'q' => $search ?: null, 'sort' => $sort ?: null])) }}"
                    class="{{ $view === 'books' && $status === 'completed' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }} px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold transition-all whitespace-nowrap">
                    Finished
                </a>
                <a href="{{ route('mylibrary', array_filter(['view' => 'achievements', 'q' => $search ?: null, 'sort' => $sort ?: null])) }}"
                    class="{{ $view === 'achievements' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }} px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold transition-all whitespace-nowrap">
                    🏆 ({{ $totalAchievements }})
                </a>
            </div>

        </section>

        {{-- DYNAMIC BOOKS GRID --}}
        @if($view === 'books' || empty($view))
        <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 lg:gap-10">
            @forelse($books as $book)
                @php
                    $progress = $book->progressRecords->first();
                    $percent = $progress->progress_percentage ?? 0;
                @endphp
                {{-- Make the whole card a clickable link to the reader --}}
                <a href="{{ route('book.read', $book) }}" class="group cursor-pointer block">
                    <div
                        class="aspect-[3/4] bg-biblo-greige rounded-[1rem] mb-3 sm:mb-5 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 relative">

                        {{-- Image Handling: Added a fallback image just in case your local EPUB covers aren't accessible
                        yet --}}
                        <img src="{{$book->cover_image}}"
                            onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'"
                            alt="{{ $book->title }} Cover"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>

                    <div class="px-2">
                        <h5 class="font-extrabold text-sm text-biblo-charcoal truncate" title="{{ $book->title }}">
                            {{ $book->title }}
                        </h5>
                        <p class="text-[11px] font-bold text-biblo-clay mt-1">
                            {{ $book->author }}
                        </p>
                        <div class="mt-2">
                            <div class="flex justify-between text-[10px] font-bold">
                                <span class="text-biblo-charcoal/40">Progress</span>
                                <span>{{ $percent }}%</span>
                            </div>

                            <div class="w-full bg-biblo-oat rounded-full h-1 mt-1">
                                <div class="bg-biblo-moss h-1 rounded-full" style="width: {{ $percent }}%">
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center py-10">
                    <p class="text-biblo-charcoal/50">Your library is currently empty.</p>
                </div>
            @endforelse
        </section>
        @endif

        {{-- ACHIEVEMENTS GRID --}}
        @if($view === 'achievements')
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 md:gap-8">
            @forelse($allAchievements as $achievement)
                @if($achievement->type === 'milestone')
                    <div class="bg-gradient-to-br {{ $achievement->color }} rounded-2xl sm:rounded-3xl p-5 sm:p-6 text-biblo-charcoal shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 group">
                        <div class="flex items-start justify-between mb-3">
                            <div>
                                <p class="text-xs font-bold opacity-60 uppercase tracking-wider">{{ $achievement->book_title }}</p>
                                <h3 class="text-xl sm:text-2xl font-black mt-1">{{ $achievement->title }}</h3>
                            </div>
                            <div class="text-4xl sm:text-5xl group-hover:scale-110 transition-transform">{{ $achievement->icon }}</div>
                        </div>
                        <p class="text-sm opacity-70 mb-3">{{ $achievement->description }}</p>
                        <p class="text-xs font-bold opacity-50 uppercase tracking-wide">Unlocked: {{ $achievement->unlocked_at }}</p>
                    </div>
                @else
                    <div class="bg-white rounded-2xl sm:rounded-3xl p-5 sm:p-6 border-2 border-biblo-moss/40 shadow-md hover:shadow-xl hover:border-biblo-moss hover:scale-105 transition-all duration-300 group">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <p class="text-xs font-bold text-biblo-moss uppercase tracking-wider">✓ Task Completed</p>
                                <h3 class="text-lg sm:text-xl font-black text-biblo-charcoal mt-1">{{ $achievement->title }}</h3>
                            </div>
                            <div class="text-3xl sm:text-4xl group-hover:scale-110 transition-transform">{{ $achievement->icon }}</div>
                        </div>
                        <p class="text-sm text-biblo-charcoal/70 mb-4">{{ $achievement->description }}</p>
                        
                        {{-- Reward Display --}}
                        <div class="flex items-center gap-3 mb-3 pt-3 border-t border-biblo-greige/30">
                            @if($achievement->coin_reward > 0)
                                <span class="inline-flex items-center gap-1 bg-biblo-clay/10 px-3 py-1.5 rounded-lg text-sm font-bold text-biblo-clay">
                                    💰 +{{ $achievement->coin_reward }}
                                </span>
                            @endif
                            @if($achievement->xp_reward > 0)
                                <span class="inline-flex items-center gap-1 bg-biblo-moss/10 px-3 py-1.5 rounded-lg text-sm font-bold text-biblo-moss">
                                    ⚡ +{{ $achievement->xp_reward }} XP
                                </span>
                            @endif
                        </div>

                        <p class="text-xs font-semibold text-biblo-charcoal/50 uppercase tracking-wide">Completed: {{ $achievement->unlocked_at }}</p>
                    </div>
                @endif
            @empty
                <div class="col-span-full text-center py-16">
                    <p class="text-4xl mb-4">🏆</p>
                    <h3 class="text-2xl font-black text-biblo-charcoal mb-2">Mulai kejar achievements!</h3>
                    <p class="text-biblo-charcoal/60">Baca buku untuk membuka badge Bronze, Silver, dan Gold</p>
                </div>
            @endforelse
        </section>
        @endif
    </div>
</x-app-layout>
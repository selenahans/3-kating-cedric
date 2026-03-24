<x-app-layout>
    <div class="space-y-12 pb-20">

        {{-- BREADCRUMBS --}}
        <nav class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-biblo-charcoal/40">
            <a href="{{ route('explore') ?? '#' }}" class="hover:text-biblo-moss transition">Explore</a>
            <span>/</span>
            <span class="text-biblo-charcoal truncate max-w-[200px]">{{ $book->title }}</span>
        </nav>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20">

            {{-- LEFT COLUMN: COVER & ACTIONS --}}
            <div class="lg:col-span-5 xl:col-span-4">
                <div class="sticky top-8 space-y-8">
                    <div
                        class="group relative aspect-[3/4] rounded-[3rem] bg-biblo-greige shadow-2xl overflow-hidden transition-all duration-700">
                        <img src="{{ asset($book->cover_image) }}"
                            onerror="this.src='https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2112&auto=format&fit=crop'"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $book->title }}">

                        <div
                            class="absolute bottom-6 right-6 bg-white/90 backdrop-blur-md px-5 py-3 rounded-[2rem] shadow-xl border border-white/20 flex items-center gap-3 animate-bounce-slow">
                            <span class="text-xl">🌱</span>
                            <div>
                                <p
                                    class="text-[10px] font-black text-biblo-moss uppercase tracking-tighter leading-none">
                                    Pet Growth</p>
                                <p class="text-xs font-bold text-biblo-charcoal">+150 XP</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        {{-- Redirects to the reader view we built earlier --}}
                        <a href="{{ route('book.read', $book) }}"
                            class="w-full flex items-center justify-center bg-biblo-charcoal text-white py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-moss transition-all hover:shadow-xl active:scale-95 shadow-lg shadow-biblo-charcoal/20">
                            Start Reading
                        </a>
                        @auth
                                        <form action="{{ route('book.toggle-library', $book->id) }}" method="POST" class="w-full">
                                            @csrf

                                            <button type="submit"
                                                class="w-full border py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase transition-all flex items-center justify-center gap-2 
                            {{ $isFavorite ? 'bg-biblo-moss text-white border-biblo-moss hover:bg-red-500 hover:border-red-500' : 'bg-white border-biblo-greige/30 text-biblo-charcoal hover:bg-biblo-oat' }}">

                                                @if($isFavorite)
                                                    <span>✓</span> In Library
                                                @else
                                                    <span>🔖</span> Save to Library
                                                @endif

                                            </button>
                                        </form>
                        @else
                            {{-- Guest users get a regular button that takes them to login --}}
                            <a href="{{ route('login') }}"
                                class="w-full bg-white border border-biblo-greige/30 text-biblo-charcoal py-5 rounded-[2rem] font-bold text-sm tracking-widest uppercase hover:bg-biblo-oat transition-all flex items-center justify-center gap-2">
                                <span>🔖</span> Save to Library
                            </a>
                        @endauth
                    </div>
                </div>
            </div>

            {{-- RIGHT COLUMN: DETAILS --}}
            <div class="lg:col-span-7 xl:col-span-8 space-y-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="bg-[#9FAF9A]/20 text-[#3F453F] text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full">
                            {{ $book->category->name ?? 'Uncategorized' }}
                        </span>
                        <div class="flex items-center gap-1 text-xs font-bold">
                            <span class="text-yellow-500">⭐</span> 4.8 <span
                                class="text-biblo-charcoal/30">(Reviews)</span>
                        </div>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-biblo-charcoal mb-4">
                        {{ $book->title }}
                    </h1>
                    <p class="text-xl font-medium text-biblo-charcoal/60">{{ $book->author }}</p>
                </div>

                {{-- STATS BOXES --}}
                <div class="flex flex-wrap gap-4">
                    <div
                        class="bg-biblo-oat/50 border border-biblo-greige/10 p-6 rounded-[2.5rem] flex-1 min-w-[140px]">
                        <p class="text-[10px] font-black text-biblo-charcoal/40 uppercase tracking-widest mb-1">Time</p>
                        {{-- Rough calculation: ~1.5 mins per page --}}
                        <p class="font-bold text-lg">{{ floor(($book->total_pages * 1.5) / 60) }}h
                            {{ round(($book->total_pages * 1.5) % 60) }}m
                        </p>
                    </div>
                    <div
                        class="bg-biblo-oat/50 border border-biblo-greige/10 p-6 rounded-[2.5rem] flex-1 min-w-[140px]">
                        <p class="text-[10px] font-black text-biblo-charcoal/40 uppercase tracking-widest mb-1">Pages
                        </p>
                        <p class="font-bold text-lg">{{ $book->total_pages }}</p>
                    </div>
                    <div
                        class="bg-biblo-oat/50 border border-biblo-greige/10 p-6 rounded-[2.5rem] flex-1 min-w-[140px]">
                        <p class="text-[10px] font-black text-biblo-charcoal/40 uppercase tracking-widest mb-1">Language
                        </p>
                        <p class="font-bold text-lg">English</p>
                    </div>
                </div>

                {{-- ABOUT SECTION --}}
                <div class="relative overflow-hidden rounded-[40px] bg-[#3F453F] p-8 md:p-12 shadow-2xl">
                    <div
                        class="pointer-events-none absolute -right-6 -top-6 select-none text-9xl font-black text-white/[0.03]">
                        ABOUT
                    </div>
                    <div class="relative z-10 space-y-6">
                        <h3 class="text-xl font-bold text-white">About This Book</h3>
                        <p class="text-white/70 leading-relaxed">
                            {{ $book->description ?? 'Dive into the pages of ' . $book->title . ', a timeless piece by ' . $book->author . '. This book belongs to the ' . ($book->category->name ?? '') . ' genre and spans ' . $book->total_pages . ' pages of captivating content.' }}
                        </p>
                    </div>
                </div>

                {{-- TABLE OF CONTENTS (Static Placeholder) --}}
                <div class="space-y-6">
                    <h3 class="font-bold text-xl px-2 text-biblo-charcoal">Table of Contents</h3>
                    <p class="text-sm text-biblo-charcoal/50 px-2">Preview available upon opening the book.</p>

                    <div class="space-y-3 opacity-50 pointer-events-none">
                        @forelse($previewChapters as $chapter)
                            <div
                                class="group flex items-center justify-between p-6 bg-white border border-biblo-greige/10 rounded-[2rem]">
                                <span class="font-bold text-biblo-charcoal/80">{{ $chapter }}</span>
                                <span class="text-biblo-greige">→</span>
                            </div>
                        @empty
                            {{-- Fallback if the XML parsing couldn't find the chapters --}}
                            <div class="p-6 bg-white border border-biblo-greige/10 rounded-[2rem] text-center">
                                <span class="font-bold text-biblo-charcoal/50">Chapters will load in the reader.</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>

        {{-- RECOMMENDATIONS SECTION --}}
        <section class="pt-10">
            <div class="flex items-center justify-between mb-8">
                <h3 class="font-bold text-2xl text-biblo-charcoal">You May Also Like</h3>
                <a href="{{ route('explore') }}" class="text-xs font-bold text-biblo-moss uppercase tracking-widest hover:underline">See
                    All</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8">
                @foreach($recommendations as $rec)
                    <a href="{{ route('book.detail', $rec) }}" class="group cursor-pointer block">
                        <div
                            class="aspect-[3/4] bg-biblo-greige rounded-[2.5rem] mb-4 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 relative">
                            <img src="{{ asset($rec->cover_image) }}"
                                onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                alt="{{ $rec->title }}">
                        </div>
                        <h5 class="font-bold text-sm truncate px-2" title="{{ $rec->title }}">{{ $rec->title }}</h5>
                        <p class="text-xs text-biblo-charcoal/40 px-2 mt-1 truncate">{{ $rec->author }}</p>
                    </a>
                @endforeach
            </div>
        </section>
    </div>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }
    </style>
</x-app-layout>
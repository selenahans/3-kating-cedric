<x-app-layout title="Jelajah" active="explore">

    @php $baseParams = [];
        if (!empty($search)) {
            $baseParams['q'] = $search;
        }
        if (!empty($categoryId)) {
            $baseParams['category'] = $categoryId;
        }
        $baseParamsWithoutCategory = $baseParams;
    unset($baseParamsWithoutCategory['category']); @endphp
    <div class="dashboard-page dashboard-explore space-y-8 md:space-y-10 lg:space-y-12">

        {{-- HEADER --}}
        <section class="flex flex-col md:flex-row md:items-center justify-between gap-6">

            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-biblo-charcoal">
                Jelajah
            </h1>

            {{-- FILTER PILLS --}}
            <div
                class="flex items-center gap-1 bg-biblo-oat p-1.5 rounded-3xl border border-biblo-greige/20 shadow-sm overflow-x-auto no-scrollbar w-full md:w-auto">

                <a href="{{ route('explore', array_merge($baseParams, ['filter' => 'all'])) }}" class="{{ ($filter ?? 'all') === 'all' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }}
        px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold whitespace-nowrap transition-all">
                    Semua
                </a>

                <a href="{{ route('explore', array_merge($baseParams, ['filter' => 'popular'])) }}" class="{{ ($filter ?? 'all') === 'popular' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }}
        px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold whitespace-nowrap transition-all">
                    Terpopuler
                </a>

                <a href="{{ route('explore', array_merge($baseParams, ['filter' => 'latest'])) }}" class="{{ ($filter ?? 'all') === 'latest' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }}
        px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold whitespace-nowrap transition-all">
                    Terbaru
                </a>

                <a href="{{ route('explore', array_merge($baseParams, ['filter' => 'free'])) }}" class="{{ ($filter ?? 'all') === 'free' ? 'bg-biblo-charcoal text-white shadow-lg' : 'text-biblo-charcoal/60 hover:bg-biblo-greige/20' }}
        px-5 sm:px-8 py-3 rounded-[20px] text-xs font-bold whitespace-nowrap transition-all">
                    Gratis
                </a>

            </div>

        </section>


        {{-- BOOK RESULTS --}}
        <section>

            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">

                <h3 class="font-bold text-xl">
                    @if(!empty($activeCategory))
                        Genre: {{ $activeCategory->name }}
                    @elseif(($filter ?? 'all') === 'popular')
                        Buku Terpopuler
                    @elseif(($filter ?? 'all') === 'latest')
                        Buku Terbaru
                    @elseif(($filter ?? 'all') === 'free')
                        Buku Gratis
                    @else
                        Semua Buku
                    @endif
                </h3>

                @if(!empty($activeCategory) || !empty($search) || ($filter ?? 'all') !== 'all')
                    <a href="{{ route('explore') }}"
                        class="text-xs font-bold text-biblo-moss uppercase tracking-widest hover:underline">
                        Atur Ulang
                    </a>
                @endif

            </div>


            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 lg:gap-10">

                @forelse($filteredBooks as $book)

                    <a href="{{ route('book.detail', $book) }}" class="group cursor-pointer block">

                        <div
                            class="aspect-[3/4] bg-biblo-greige rounded-[1rem] mb-3 sm:mb-5 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500">

                            <img src="{{ asset($book->cover_image) }}"
                                onerror="this.src='https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop'"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
                                alt="{{ $book->title }}">

                        </div>

                        <div class="px-2">

                            <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">
                                {{ $book->title }}
                            </h5>

                            <p class="text-[11px] font-bold text-biblo-clay mt-1">
                                {{ $book->author }}
                            </p>

                        </div>

                    </a>

                @empty

                    <div class="col-span-full text-center py-10">
                        <p class="text-biblo-charcoal/50">Tidak ada buku pada filter ini.</p>
                    </div>

                @endforelse

            </div>

        </section>


        {{-- GENRE SECTION --}}
        <section class="relative overflow-hidden rounded-[32px] bg-[#3F453F] p-6 sm:p-8 md:p-12 shadow-2xl">

            <div class="pointer-events-none absolute -right-6 -top-6 text-8xl font-black text-white/[0.03]">
                GENRE
            </div>

            <div class="relative z-10">

                <div class="mb-8 text-center md:text-left">
                    <h3 class="text-2xl font-bold text-white">
                        Jelajah Berdasarkan Genre
                    </h3>
                    <p class="text-white/40 text-sm">
                        Temukan bacaan sesuai minatmu
                    </p>
                </div>

                <div class="flex flex-wrap gap-3 sm:gap-4 justify-center md:justify-start">

                    @foreach($genres as $genre)

                        <a href="{{ route('explore', array_merge($baseParams, ['category' => $genre->id])) }}" class="group flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 text-white
                            hover:bg-[#9FAF9A] hover:text-[#3F453F] hover:border-[#9FAF9A]
                            px-4 sm:px-6 py-3 text-xs sm:text-sm font-bold transition-all">

                            <span class="text-lg">
                                📚
                            </span>

                            <span>{{ $genre->name }}</span>

                        </a>

                    @endforeach

                </div>

            </div>

        </section>


        {{-- POPULAR THIS WEEK --}}
        <section>

            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <h3 class="font-bold text-xl">Populer Minggu Ini</h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 lg:gap-10">

                @foreach($popularBooks as $book)

                    <a href="{{ route('book.detail', $book) }}" class="group cursor-pointer block">

                        <div
                            class="aspect-[3/4] bg-biblo-greige rounded-[1rem] mb-3 sm:mb-5 overflow-hidden shadow-md group-hover:shadow-xl">

                            <img src="{{ asset($book->cover_image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform">

                        </div>

                        <div class="px-2">

                            <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">
                                {{ $book->title }}
                            </h5>

                            <p class="text-[11px] font-bold text-biblo-clay mt-1">
                                {{ $book->author }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>


        {{-- NEW ARRIVALS --}}
        <section>

            <div class="flex flex-wrap items-center justify-between gap-3 mb-6">
                <h3 class="font-bold text-xl">Rilis Terbaru</h3>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 sm:gap-6 lg:gap-10">

                @foreach($newArrivals as $book)

                    <a href="{{ route('book.detail', $book) }}" class="group cursor-pointer block">

                        <div
                            class="aspect-[3/4] bg-biblo-greige rounded-[1rem] mb-3 sm:mb-5 overflow-hidden shadow-md group-hover:shadow-xl">

                            <img src="{{ asset($book->cover_image) }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform">

                        </div>

                        <div class="px-2">

                            <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">
                                {{ $book->title }}
                            </h5>

                            <p class="text-[11px] font-bold text-biblo-clay mt-1">
                                {{ $book->author }}
                            </p>

                        </div>

                    </a>

                @endforeach

            </div>

        </section>

    </div>
</x-app-layout>
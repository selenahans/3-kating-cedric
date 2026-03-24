<x-app-layout title="Hasil Pencarian" active="explore">
    <div class="space-y-8 md:space-y-10 lg:space-y-12">
        <section class="bg-white rounded-[28px] sm:rounded-[36px] p-6 sm:p-8 border border-biblo-greige/20 shadow-sm">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-2">Global Search</p>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-biblo-charcoal">Hasil Pencarian</h1>
            @if($search !== '')
                <p class="mt-3 text-sm text-biblo-charcoal/60">
                    Menampilkan hasil untuk <span class="font-bold text-biblo-charcoal">"{{ $search }}"</span>
                </p>
            @else
                <p class="mt-3 text-sm text-biblo-charcoal/60">
                    Ketik kata kunci di searchbar atas untuk mencari buku, kategori, atau catatan.
                </p>
            @endif
        </section>

        @if($search !== '')
            <section class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-3xl border border-biblo-greige/20 p-5 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/50">Buku</p>
                    <p class="mt-2 text-3xl font-extrabold text-biblo-charcoal">{{ count($books) }}</p>
                </div>
                <div class="bg-white rounded-3xl border border-biblo-greige/20 p-5 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/50">Kategori</p>
                    <p class="mt-2 text-3xl font-extrabold text-biblo-charcoal">{{ count($categories) }}</p>
                </div>
                <div class="bg-white rounded-3xl border border-biblo-greige/20 p-5 shadow-sm">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/50">Catatan</p>
                    <p class="mt-2 text-3xl font-extrabold text-biblo-charcoal">{{ count($notes) }}</p>
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-xl font-extrabold text-biblo-charcoal">Buku</h2>
                    <a href="{{ route('explore', ['q' => $search]) }}" class="text-xs font-black uppercase tracking-[0.2em] text-biblo-moss hover:underline">Lihat di Explore</a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    @forelse($books as $book)
                        <a href="{{ route('book.detail', $book) }}" class="group bg-white rounded-3xl border border-biblo-greige/20 p-4 shadow-sm hover:shadow-md transition-all">
                            <p class="text-sm font-extrabold text-biblo-charcoal line-clamp-2">{{ $book->title }}</p>
                            <p class="text-xs font-bold text-biblo-clay mt-1">{{ $book->author }}</p>
                            <p class="text-[11px] text-biblo-charcoal/60 mt-3">
                                Kategori: {{ $book->category->name ?? '-' }}
                            </p>
                        </a>
                    @empty
                        <p class="text-sm text-biblo-charcoal/50">Tidak ada buku yang cocok.</p>
                    @endforelse
                </div>
            </section>

            <section class="space-y-4">
                <h2 class="text-xl font-extrabold text-biblo-charcoal">Kategori</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    @forelse($categories as $category)
                        <a href="{{ route('explore', ['category' => $category->id]) }}" class="bg-white rounded-3xl border border-biblo-greige/20 p-5 shadow-sm hover:shadow-md transition-all">
                            <p class="text-sm font-extrabold text-biblo-charcoal">{{ $category->name }}</p>
                            <p class="text-xs text-biblo-charcoal/60 mt-2">
                                {{ $category->books_count }} buku
                            </p>
                        </a>
                    @empty
                        <p class="text-sm text-biblo-charcoal/50">Tidak ada kategori yang cocok.</p>
                    @endforelse
                </div>
            </section>

            <section class="space-y-4">
                <div class="flex items-center justify-between gap-3">
                    <h2 class="text-xl font-extrabold text-biblo-charcoal">Catatan</h2>
                    <a href="{{ route('notes.index', ['q' => $search]) }}" class="text-xs font-black uppercase tracking-[0.2em] text-biblo-moss hover:underline">Lihat Semua Catatan</a>
                </div>

                <div class="space-y-3">
                    @forelse($notes as $note)
                        <div class="bg-white rounded-3xl border border-biblo-greige/20 p-5 shadow-sm">
                            <div class="flex flex-wrap items-center gap-2 text-[11px] font-black uppercase tracking-[0.08em] text-biblo-charcoal/40">
                                <span>{{ $note->book->title ?? 'Tanpa Buku' }}</span>
                                <span>•</span>
                                <span>{{ optional($note->book->category)->name ?? 'Tanpa Kategori' }}</span>
                            </div>
                            <p class="mt-3 text-sm font-bold text-biblo-charcoal line-clamp-2">
                                "{{ $note->highlighted_text }}"
                            </p>
                            @if(!empty($note->note_content))
                                <p class="mt-2 text-sm text-biblo-charcoal/70 line-clamp-2">{{ $note->note_content }}</p>
                            @endif
                        </div>
                    @empty
                        <p class="text-sm text-biblo-charcoal/50">Tidak ada catatan yang cocok.</p>
                    @endforelse
                </div>
            </section>
        @endif
    </div>
</x-app-layout>

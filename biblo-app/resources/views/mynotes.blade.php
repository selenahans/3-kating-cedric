<x-app-layout title="My Notes" active="notes">
    <div class="max-w-5xl mx-auto space-y-8 md:space-y-10">

        @if(session('status'))
            <div class="bg-biblo-sage/20 border border-biblo-sage/40 text-biblo-charcoal px-4 py-3 rounded-2xl text-sm font-bold">
                {{ session('status') }}
            </div>
        @endif

        <header class="flex flex-col lg:flex-row items-start lg:items-center justify-between w-full gap-6 lg:gap-12 mb-8 md:mb-12">
            <div class="flex-shrink-0">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-1">Knowledge Archive</p>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-biblo-charcoal tracking-tighter leading-none">
                    My <span class="text-biblo-clay/50 italic font-medium">Notes</span>
                </h1>
            </div>
            
            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 sm:gap-4 w-full lg:w-auto lg:flex-1 lg:justify-end">
                <div class="relative w-full sm:flex-1 sm:max-w-2xl group"> 
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-lg opacity-40 group-focus-within:opacity-100 transition-opacity">🔍</span>
                    <input type="text" placeholder="Search from your library..." 
                           class="w-full bg-white border border-biblo-greige/20 pl-14 pr-6 py-3 sm:py-4 rounded-[20px] sm:rounded-[24px] shadow-sm focus:outline-none focus:ring-2 focus:ring-biblo-sage/20 transition-all text-sm font-bold text-biblo-charcoal placeholder:text-biblo-charcoal/20">
                </div>
                
                <button class="w-full sm:w-auto flex-shrink-0 bg-biblo-charcoal text-white h-12 sm:h-[56px] px-6 sm:px-10 rounded-[18px] sm:rounded-[22px] shadow-xl shadow-biblo-charcoal/10 text-[10px] sm:text-[11px] font-black uppercase tracking-[0.2em] hover:bg-biblo-moss hover:-translate-y-1 active:translate-y-0 transition-all flex items-center justify-center">
                    FILTER
                </button>
            </div>
        </header>

        <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 text-biblo-charcoal">

            {{-- DYNAMIC NOTES LIST --}}
            <div class="lg:col-span-9 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @forelse($notes as $note)
                    <div class="bg-white p-4 sm:p-5 rounded-[24px] sm:rounded-[28px] border border-biblo-greige/20 shadow-sm relative overflow-hidden h-full flex flex-col">
                        {{-- We use the dynamic color code from your DB for the glow effect! --}}
                        <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full blur-3xl opacity-20" style="background-color: {{ $note->color_code ?? '#B5EAD7' }};"></div>

                        <div class="flex items-start justify-between gap-3 mb-4 relative z-10">
                            <div class="flex items-start gap-3 min-w-0">
                                <div class="w-11 h-11 bg-biblo-oat rounded-2xl flex items-center justify-center text-xl shadow-inner border border-biblo-greige/10 flex-shrink-0">
                                    📘
                                </div>
                                <div class="min-w-0">
                                    <h2 class="text-lg font-extrabold tracking-tight truncate">{{ $note->book->title }}</h2>
                                    <p class="text-[10px] font-black text-biblo-charcoal/40 uppercase tracking-[0.1em] truncate">
                                        {{ $note->book->author }} • {{ $note->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="bg-biblo-sage/10 text-biblo-moss px-3 py-1 rounded-full text-[9px] font-black uppercase self-start flex-shrink-0">
                                Highlight
                            </div>
                        </div>

                        <div class="space-y-4 relative z-10 flex-grow flex flex-col">
                            <div class="space-y-2">
                                <p class="text-[9px] font-black text-biblo-charcoal/30 uppercase tracking-[0.2em]">The Insight</p>
                                <div class="relative">
                                    <p class="text-lg font-bold leading-relaxed tracking-tight line-clamp-4">
                                        "{{ $note->highlighted_text }}"
                                    </p>
                                </div>
                            </div>

                            {{-- Only show the reflection box if the user actually typed a note! --}}
                            @if($note->note_content)
                                <div class="bg-biblo-oat/50 rounded-2xl p-4 border border-biblo-greige/10">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="text-sm">✍️</span>
                                        <p class="text-[10px] font-black text-biblo-charcoal/60 uppercase tracking-widest">Personal Reflection</p>
                                    </div>
                                    <p class="text-sm font-medium leading-relaxed text-biblo-charcoal/80 line-clamp-4">
                                        {{ $note->note_content }}
                                    </p>
                                </div>
                            @endif

                            <details class="bg-white/70 border border-biblo-greige/20 rounded-xl p-3 mt-auto">
                                <summary class="cursor-pointer text-xs font-black uppercase tracking-[0.12em] text-biblo-charcoal/60">
                                    Edit Note
                                </summary>

                                <form action="{{ route('notes.update', $note) }}" method="POST" class="mt-4 space-y-3">
                                    @csrf
                                    @method('PATCH')

                                    <textarea name="note_content" rows="4"
                                        class="w-full bg-white border border-biblo-greige/30 rounded-xl p-3 text-sm focus:ring-2 focus:ring-biblo-sage/20 focus:outline-none"
                                        placeholder="Tulis atau ubah isi catatan...">{{ old('note_content', $note->note_content) }}</textarea>

                                    <div class="flex items-center justify-between gap-3 flex-wrap">
                                        <input type="color" name="color_code" value="{{ $note->color_code ?? '#FDE047' }}"
                                            class="h-10 w-16 rounded-lg border border-biblo-greige/30 bg-white p-1">
                                        <button type="submit"
                                            class="px-5 py-2.5 rounded-xl bg-biblo-charcoal text-white text-xs font-black uppercase tracking-[0.12em] hover:bg-biblo-moss transition-all">
                                            Simpan Edit
                                        </button>
                                    </div>
                                </form>
                            </details>

                            <form action="{{ route('notes.destroy', $note) }}" method="POST"
                                onsubmit="return confirm('Yakin mau hapus note ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-red-50 text-red-600 border border-red-200 text-xs font-black uppercase tracking-[0.12em] hover:bg-red-100 transition-all">
                                    Hapus Note
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 md:col-span-2 xl:col-span-3">
                        <p class="text-biblo-charcoal/40 font-bold">You haven't highlighted any text or saved any notes yet.</p>
                        <p class="text-sm text-biblo-charcoal/30 mt-2">Open a book in your library and start highlighting!</p>
                    </div>
                @endforelse
            </div>

            {{-- DYNAMIC STATS SIDEBAR --}}
            <div class="space-y-6 lg:col-span-3">
                <div class="bg-biblo-charcoal rounded-[28px] sm:rounded-[36px] lg:rounded-[45px] p-5 sm:p-6 lg:p-8 text-white relative overflow-hidden flex flex-col h-full">
                    <h3 class="text-lg font-extrabold mb-6">Reading Stats</h3>

                    <div class="space-y-6 flex-grow">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 border border-white/10 p-4 rounded-3xl text-center">
                                <p class="text-2xl mb-1">📝</p>
                                <p class="text-[9px] font-black uppercase text-white/40 leading-none">Total Notes</p>
                                <p class="text-xl font-extrabold mt-1">{{ $totalNotes }}</p>
                            </div>
                            <div class="bg-white/5 border border-white/10 p-4 rounded-3xl text-center">
                                <p class="text-2xl mb-1">✨</p>
                                <p class="text-[9px] font-black uppercase text-white/40 leading-none">Highlights</p>
                                <p class="text-xl font-extrabold mt-1">{{ $totalHighlights }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-white/10">
                        <p class="text-[10px] font-bold text-white/40 leading-relaxed italic mb-4">
                            "Reviewing your notes helps Lumi grow smarter and unlocks new evolutions!"
                        </p>
                        <a href="{{ route('notes.export-pdf') }}"
                            class="inline-flex items-center justify-center px-6 bg-white/5 hover:bg-white/10 border border-white/10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all">
                            Export PDF
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
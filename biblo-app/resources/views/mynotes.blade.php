<x-app-layout title="My Notes" active="notes">
    <div class="max-w-5xl mx-auto space-y-10">

        <header class="flex items-center justify-between w-full gap-12 mb-12">
            <div class="flex-shrink-0">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/60 mb-1">Knowledge Archive</p>
                <h1 class="text-6xl font-extrabold text-biblo-charcoal tracking-tighter leading-none">
                    My <span class="text-biblo-clay/50 italic font-medium">Notes</span>
                </h1>
            </div>
            
            <div class="flex items-center gap-4 flex-1 justify-end">
                <div class="relative flex-1 max-w-2xl group"> 
                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-lg opacity-40 group-focus-within:opacity-100 transition-opacity">🔍</span>
                    <input type="text" placeholder="Search from your library..." 
                           class="w-full bg-white border border-biblo-greige/20 pl-14 pr-6 py-4 rounded-[24px] shadow-sm focus:outline-none focus:ring-2 focus:ring-biblo-sage/20 transition-all text-sm font-bold text-biblo-charcoal placeholder:text-biblo-charcoal/20">
                </div>
                
                <button class="flex-shrink-0 bg-biblo-charcoal text-white h-[56px] px-10 rounded-[22px] shadow-xl shadow-biblo-charcoal/10 text-[11px] font-black uppercase tracking-[0.2em] hover:bg-biblo-moss hover:-translate-y-1 active:translate-y-0 transition-all flex items-center justify-center">
                    FILTER
                </button>
            </div>
        </header>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8 text-biblo-charcoal">

            {{-- DYNAMIC NOTES LIST --}}
            <div class="lg:col-span-2 space-y-6">
                @forelse($notes as $note)
                    <div class="bg-white p-8 rounded-[45px] border border-biblo-greige/20 shadow-sm relative overflow-hidden">
                        {{-- We use the dynamic color code from your DB for the glow effect! --}}
                        <div class="absolute -top-10 -right-10 w-32 h-32 rounded-full blur-3xl opacity-20" style="background-color: {{ $note->color_code ?? '#B5EAD7' }};"></div>

                        <div class="flex items-start justify-between mb-8 relative z-10">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 bg-biblo-oat rounded-[24px] flex items-center justify-center text-3xl shadow-inner border border-biblo-greige/10">
                                    📘
                                </div>
                                <div>
                                    <h2 class="text-2xl font-extrabold tracking-tight">{{ $note->book->title }}</h2>
                                    <p class="text-[11px] font-black text-biblo-charcoal/40 uppercase tracking-[0.1em]">
                                        {{ $note->book->author }} • {{ $note->created_at->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="bg-biblo-sage/10 text-biblo-moss px-4 py-1.5 rounded-full text-[10px] font-black uppercase">
                                Highlight
                            </div>
                        </div>

                        <div class="space-y-8 relative z-10">
                            <div class="space-y-3">
                                <p class="text-[9px] font-black text-biblo-charcoal/30 uppercase tracking-[0.2em]">The Insight</p>
                                <div class="relative">
                                    <p class="text-xl md:text-2xl font-bold leading-relaxed tracking-tight">
                                        "{{ $note->highlighted_text }}"
                                    </p>
                                </div>
                            </div>

                            {{-- Only show the reflection box if the user actually typed a note! --}}
                            @if($note->note_content)
                                <div class="bg-biblo-oat/50 rounded-[32px] p-6 border border-biblo-greige/10">
                                    <div class="flex items-center gap-2 mb-3">
                                        <span class="text-sm">✍️</span>
                                        <p class="text-[10px] font-black text-biblo-charcoal/60 uppercase tracking-widest">Personal Reflection</p>
                                    </div>
                                    <p class="text-sm font-medium leading-relaxed text-biblo-charcoal/80">
                                        {{ $note->note_content }}
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20">
                        <p class="text-biblo-charcoal/40 font-bold">You haven't highlighted any text or saved any notes yet.</p>
                        <p class="text-sm text-biblo-charcoal/30 mt-2">Open a book in your library and start highlighting!</p>
                    </div>
                @endforelse
            </div>

            {{-- DYNAMIC STATS SIDEBAR --}}
            <div class="space-y-6">
                <div class="bg-biblo-charcoal rounded-[45px] p-8 text-white relative overflow-hidden flex flex-col h-full">
                    <h3 class="text-lg font-extrabold mb-6">Reading Stats</h3>

                    <div class="space-y-6 flex-grow">
                        <div>
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-tighter mb-2">
                                <span class="text-white/40">Knowledge Gain</span>
                                <span class="text-biblo-sage">+12% This Week</span>
                            </div>
                            <div class="w-full bg-white/10 h-2 rounded-full overflow-hidden">
                                <div class="bg-biblo-sage h-full rounded-full shadow-[0_0_10px_rgba(181,234,215,0.4)]" style="width: 65%"></div>
                            </div>
                        </div>

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
                        <button class="w-full bg-white/5 hover:bg-white/10 border border-white/10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all">
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
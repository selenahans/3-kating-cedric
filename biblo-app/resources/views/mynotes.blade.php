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

            <div class="lg:col-span-2 space-y-6">
                <div
                    class="bg-white p-8 rounded-[45px] border border-biblo-greige/20 shadow-sm relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-biblo-sage/5 rounded-full blur-3xl"></div>

                    <div class="flex items-start justify-between mb-8 relative z-10">
                        <div class="flex items-center gap-5">
                            <div
                                class="w-16 h-16 bg-biblo-oat rounded-[24px] flex items-center justify-center text-3xl shadow-inner border border-biblo-greige/10">
                                📘</div>
                            <div>
                                <h2 class="text-2xl font-extrabold tracking-tight">Atomic Habits</h2>
                                <p class="text-[11px] font-black text-biblo-charcoal/40 uppercase tracking-[0.1em]">
                                    James Clear • Page 34</p>
                            </div>
                        </div>
                        <div
                            class="bg-biblo-sage/10 text-biblo-moss px-4 py-1.5 rounded-full text-[10px] font-black uppercase">
                            Highlight</div>
                    </div>

                    <div class="space-y-8 relative z-10">
                        <div class="space-y-3">
                            <p class="text-[9px] font-black text-biblo-charcoal/30 uppercase tracking-[0.2em]">The
                                Insight</p>
                            <div class="relative">
                                <p class="text-xl md:text-2xl font-bold leading-relaxed tracking-tight">
                                    "You do not <span class="relative inline-block">
                                        <span
                                            class="absolute inset-x-0 bottom-1 h-3 bg-biblo-clay/20 -rotate-1 rounded-sm"></span>
                                        <span class="relative">rise to the level</span>
                                    </span> of your goals. You <span class="relative inline-block">
                                        <span
                                            class="absolute inset-x-0 bottom-1 h-3 bg-biblo-clay/20 rotate-1 rounded-sm"></span>
                                        <span class="relative">fall to the level</span>
                                    </span> of your systems."
                                </p>
                            </div>
                        </div>

                        <div class="bg-biblo-oat/50 rounded-[32px] p-6 border border-biblo-greige/10">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="text-sm">✍️</span>
                                <p class="text-[10px] font-black text-biblo-charcoal/60 uppercase tracking-widest">
                                    Personal Reflection</p>
                            </div>
                            <p class="text-sm font-medium leading-relaxed text-biblo-charcoal/80">
                                Habits shape identity. Jangan cuma fokus ke *output* (goal), tapi rapihin *input* dan
                                proses harian. Sistem yang baik bikin kemajuan jadi otomatis.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-white/60 backdrop-blur-xl border border-biblo-greige/20 p-6 rounded-[32px] hover:shadow-lg transition-all cursor-pointer group">
                        <p class="text-[9px] font-black text-biblo-clay uppercase mb-2 italic">Ref. Psychology of Money
                        </p>
                        <h4 class="font-extrabold text-sm mb-2 group-hover:text-biblo-clay transition-colors">Wealth is
                            what you don't see.</h4>
                        <div
                            class="h-1 w-8 bg-biblo-clay/20 rounded-full group-hover:w-full transition-all duration-500">
                        </div>
                    </div>
                    <div
                        class="bg-white/60 backdrop-blur-xl border border-biblo-greige/20 p-6 rounded-[32px] hover:shadow-lg transition-all cursor-pointer group">
                        <p class="text-[9px] font-black text-biblo-moss uppercase mb-2 italic">Ref. Deep Work</p>
                        <h4 class="font-extrabold text-sm mb-2 group-hover:text-biblo-moss transition-colors">Schedule
                            every minute of your day.</h4>
                        <div
                            class="h-1 w-8 bg-biblo-moss/20 rounded-full group-hover:w-full transition-all duration-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="bg-biblo-charcoal rounded-[45px] p-8 text-white relative overflow-hidden flex flex-col h-full">
                    <h3 class="text-lg font-extrabold mb-6">Reading Stats</h3>

                    <div class="space-y-6 flex-grow">
                        <div>
                            <div class="flex justify-between text-[10px] font-black uppercase tracking-tighter mb-2">
                                <span class="text-white/40">Knowledge Gain</span>
                                <span class="text-biblo-sage">+12% This Week</span>
                            </div>
                            <div class="w-full bg-white/10 h-2 rounded-full overflow-hidden">
                                <div class="bg-biblo-sage h-full rounded-full shadow-[0_0_10px_rgba(181,234,215,0.4)]"
                                    style="width: 65%"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/5 border border-white/10 p-4 rounded-3xl text-center">
                                <p class="text-2xl mb-1">📝</p>
                                <p class="text-[9px] font-black uppercase text-white/40 leading-none">Total Notes</p>
                                <p class="text-xl font-extrabold mt-1">128</p>
                            </div>
                            <div class="bg-white/5 border border-white/10 p-4 rounded-3xl text-center">
                                <p class="text-2xl mb-1">✨</p>
                                <p class="text-[9px] font-black uppercase text-white/40 leading-none">Highlights</p>
                                <p class="text-xl font-extrabold mt-1">452</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-white/10">
                        <p class="text-[10px] font-bold text-white/40 leading-relaxed italic mb-4">
                            "Reviewing your notes helps Lumi grow smarter and unlocks new evolutions!"
                        </p>
                        <button
                            class="w-full bg-white/5 hover:bg-white/10 border border-white/10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all">
                            Export PDF
                        </button>
                    </div>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
<x-app-layout title="My Pet" active="pet">
    <div class="max-w-5xl mx-auto space-y-10">
        
        <header class="flex flex-col md:flex-row justify-between items-end gap-4">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss mb-1">Companion Status</p>
                <h1 class="text-4xl font-extrabold text-biblo-charcoal tracking-tighter">Meet, <span class="text-biblo-clay">Lumi</span></h1>
            </div>
            <div class="flex gap-3">
                {{-- href="{{ route('mylibrary') }}" --}}
                <a  class="bg-white border border-biblo-greige/30 px-6 py-3 rounded-2xl shadow-sm flex items-center gap-2 hover:bg-biblo-oat transition-all group">
                    <span class="text-lg group-hover:rotate-12 transition-transform">📚</span>
                    <span class="text-xs font-black text-biblo-charcoal uppercase tracking-widest">Library</span>
                </a>
                <div class="bg-white border border-biblo-greige/30 px-6 py-3 rounded-2xl shadow-sm">
                    <p class="text-[9px] font-black text-biblo-charcoal/40 uppercase tracking-widest">Growth Level</p>
                    <p class="text-xl font-extrabold text-biblo-charcoal">Lv. 14 <span class="text-xs font-bold text-biblo-moss ml-1">Adolescent</span></p>
                </div>
            </div>
        </header>

        <section class="relative bg-biblo-oat rounded-[60px] aspect-video md:aspect-[21/9] overflow-hidden flex items-center justify-center border border-biblo-greige/20 shadow-inner">
            <div class="absolute top-10 left-10 w-32 h-32 bg-biblo-sage/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-20 w-48 h-48 bg-biblo-clay/10 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col items-center group">
                <div class="absolute -bottom-4 w-24 h-4 bg-biblo-charcoal/10 rounded-[100%] blur-md group-hover:scale-110 transition-transform duration-700"></div>
                
                <div class="text-9xl animate-bounce-slow cursor-pointer hover:scale-110 transition-transform duration-500">
                    🦊
                </div>
                
                <div class="mt-8 bg-white/40 backdrop-blur-md border border-white/50 px-4 py-1.5 rounded-full shadow-sm">
                    <p class="text-[10px] font-black text-biblo-charcoal uppercase tracking-tighter">"Sudah baca apa hari ini?"</p>
                </div>
            </div>

            <div class="absolute bottom-8 left-8 right-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                    $stats = [
                        ['label' => 'Hunger', 'val' => '80%', 'color' => 'bg-biblo-clay'],
                        ['label' => 'Happiness', 'val' => '95%', 'color' => 'bg-biblo-sage'],
                        ['label' => 'Knowledge', 'val' => '42%', 'color' => 'bg-biblo-moss'],
                        ['label' => 'Exp', 'val' => '120/500', 'color' => 'bg-biblo-charcoal'],
                    ];
                @endphp

                @foreach($stats as $stat)
                <div class="bg-white/60 backdrop-blur-xl border border-white/40 p-4 rounded-[2rem] shadow-sm">
                    <p class="text-[9px] font-black text-biblo-charcoal/50 uppercase mb-2">{{ $stat['label'] }}</p>
                    <div class="w-full bg-biblo-charcoal/5 h-1.5 rounded-full overflow-hidden">
                        <div class="{{ $stat['color'] }} h-full rounded-full" style="width: {{ str_contains($stat['val'], '%') ? $stat['val'] : '40%' }}"></div>
                    </div>
                    <p class="text-xs font-bold text-biblo-charcoal mt-2">{{ $stat['val'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-extrabold text-biblo-charcoal px-2">Growth Quests</h3>
                
                <div class="space-y-3">
                    <div class="bg-white p-5 rounded-[32px] border border-biblo-greige/20 flex items-center justify-between group hover:shadow-xl hover:shadow-biblo-sage/5 transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-biblo-sage/10 rounded-2xl flex items-center justify-center text-xl">📖</div>
                            <div>
                                <h4 class="font-bold text-sm text-biblo-charcoal">Read for 20 Minutes</h4>
                                <p class="text-[11px] text-biblo-charcoal/40 font-bold">+50 EXP & +20 Hunger</p>
                            </div>
                        </div>
                        <button class="bg-biblo-charcoal text-white text-[10px] font-black px-6 py-2.5 rounded-xl hover:bg-biblo-moss transition-colors">START</button>
                    </div>

                    <div class="bg-white p-5 rounded-[32px] border border-biblo-greige/20 flex items-center justify-between opacity-60">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-biblo-clay/10 rounded-2xl flex items-center justify-center text-xl">✍️</div>
                            <div>
                                <h4 class="font-bold text-sm text-biblo-charcoal">Write a Chapter Summary</h4>
                                <p class="text-[11px] text-biblo-charcoal/40 font-bold">+100 EXP & +10 Knowledge</p>
                            </div>
                        </div>
                        <div class="text-biblo-moss text-xs font-black">COMPLETED ✅</div>
                    </div>
                </div>
            </div>

            <div class="bg-biblo-charcoal rounded-[45px] p-8 text-white relative overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-extrabold">Pet Treats</h3>
                        <a  class="bg-biblo-clay text-white p-2.5 rounded-xl hover:scale-110 transition-all shadow-lg shadow-biblo-clay/20 group" title="Buy more treats">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        </a>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <button class="bg-white/10 hover:bg-white/20 border border-white/10 p-4 rounded-3xl transition-all flex flex-col items-center gap-2">
                            <span class="text-2xl">🍎</span>
                            <span class="text-[10px] font-black uppercase tracking-tighter">Organic Apple</span>
                            <span class="text-[9px] text-biblo-sage font-bold">Qty: 12</span>
                        </button>
                        <button class="bg-white/10 hover:bg-white/20 border border-white/10 p-4 rounded-3xl transition-all flex flex-col items-center gap-2">
                            <span class="text-2xl">🍯</span>
                            <span class="text-[10px] font-black uppercase tracking-tighter">Sweet Honey</span>
                            <span class="text-[9px] text-biblo-sage font-bold">Qty: 05</span>
                        </button>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-white/10">
                    <p class="text-[10px] font-bold text-white/40 leading-relaxed italic mb-4">
                        "Give Lumi treats earned from finishing book chapters to keep them happy!"
                    </p>
                    {{-- href="{{ route('shop') }}" --}}
                    <a  class="block text-center bg-white/5 hover:bg-white/10 border border-white/10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all">
                        Go to Shop
                    </a>
                </div>
            </div>

        </section>
    </div>
</x-app-layout>
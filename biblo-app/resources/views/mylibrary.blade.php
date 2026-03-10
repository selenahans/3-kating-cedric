<x-app-layout title="My Library" active="library">
    <div class="space-y-12">
        
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-biblo-charcoal rounded-[45px] p-8 text-white relative overflow-hidden shadow-2xl shadow-biblo-charcoal/20 group">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-sage mb-2">My Collection</p>
                    <h2 class="text-5xl font-extrabold tracking-tighter">24 <span class="text-sm font-bold text-biblo-greige/60 ml-2 uppercase">Books</span></h2>
                </div>
                <div class="absolute -right-6 -bottom-6 text-9xl opacity-10 group-hover:scale-110 transition-transform">📚</div>
            </div>
            
            <div class="bg-white rounded-[45px] p-8 border border-biblo-greige/30 shadow-sm flex items-center justify-between group hover:border-biblo-sage transition-all">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/40 mb-2">On Progress</p>
                    <h2 class="text-4xl font-extrabold text-biblo-charcoal">03</h2>
                </div>
                <div class="w-16 h-16 bg-biblo-sage/20 rounded-[2rem] flex items-center justify-center text-3xl group-hover:rotate-12 transition-transform">⌛</div>
            </div>

            <div class="bg-white rounded-[45px] p-8 border border-biblo-greige/30 shadow-sm flex items-center justify-between group hover:border-biblo-moss transition-all">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-charcoal/40 mb-2">Completed</p>
                    <h2 class="text-4xl font-extrabold text-biblo-charcoal">19</h2>
                </div>
                <div class="w-16 h-16 bg-biblo-moss/20 rounded-[2rem] flex items-center justify-center text-3xl group-hover:scale-110 transition-transform">✅</div>
            </div>
        </section>

        <section class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-1 bg-biblo-oat p-1.5 rounded-3xl border border-biblo-greige/20 shadow-sm">
                <button class="bg-biblo-charcoal text-white px-8 py-3 rounded-[20px] text-xs font-bold transition-all shadow-lg">All Books</button>
                <button class="text-biblo-charcoal/60 px-8 py-3 rounded-[20px] text-xs font-bold hover:bg-biblo-greige/20 transition-all">Reading</button>
                <button class="text-biblo-charcoal/60 px-8 py-3 rounded-[20px] text-xs font-bold hover:bg-biblo-greige/20 transition-all">Finished</button>
                <button class="text-biblo-charcoal/60 px-8 py-3 rounded-[20px] text-xs font-bold hover:bg-biblo-greige/20 transition-all">Wishlist</button>
            </div>
            
            <div class="flex items-center gap-3">
                <button class="flex items-center gap-2 px-6 py-3 bg-white border border-biblo-greige/30 rounded-2xl text-xs font-bold text-biblo-charcoal hover:bg-biblo-oat transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-biblo-clay"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg>
                    Filter
                </button>
            </div>
        </section>

        <section class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-10">
            <div class="group cursor-pointer">
                <div class="aspect-[3/4] bg-biblo-greige rounded-[3rem] mb-5 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 relative">
                    <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    
                    <div class="absolute bottom-4 left-4 right-4 bg-biblo-oat/90 backdrop-blur-md rounded-[2rem] p-4 shadow-xl translate-y-2 group-hover:translate-y-0 transition-transform border border-white/20">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-black text-biblo-moss uppercase tracking-widest">65% Done</span>
                        </div>
                        <div class="w-full bg-biblo-charcoal/10 rounded-full h-1.5">
                            <div class="bg-biblo-moss h-1.5 rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">Atomic Habits</h5>
                    <p class="text-[11px] font-bold text-biblo-clay mt-1">James Clear</p>
                </div>
            </div>

            <div class="group cursor-pointer">
                <div class="aspect-[3/4] bg-biblo-greige rounded-[3rem] mb-5 overflow-hidden shadow-md group-hover:shadow-xl transition-all duration-500 relative">
                    <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2112&auto=format&fit=crop" class="w-full h-full object-cover opacity-50 grayscale group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500">
                    <div class="absolute inset-0 flex items-center justify-center opacity-100 group-hover:opacity-0 transition-opacity">
                        <div class="bg-biblo-charcoal text-white text-[9px] font-black tracking-widest px-5 py-2.5 rounded-full shadow-lg">FINISHED</div>
                    </div>
                </div>
                <div class="px-2">
                    <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">Psychology of Money</h5>
                    <p class="text-[11px] font-bold text-biblo-clay mt-1">Morgan Housel</p>
                </div>
            </div>

            @foreach(range(1, 3) as $i)
            <div class="group cursor-pointer">
                <div class="aspect-[3/4] bg-biblo-oat rounded-[3rem] mb-5 overflow-hidden shadow-sm group-hover:shadow-xl transition-all duration-500 border border-biblo-greige/20">
                    <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?q=80&w=1948&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition-all">
                </div>
                <div class="px-2">
                    <h5 class="font-extrabold text-sm text-biblo-charcoal truncate">The Alchemist</h5>
                    <p class="text-[11px] font-bold text-biblo-clay mt-1">Paulo Coelho</p>
                </div>
            </div>
            @endforeach
        </section>
    </div>
</x-app-layout>
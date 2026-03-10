<x-app-layout>
    <div class="space-y-12">
        
        <section class="space-y-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <h1 class="text-3xl font-extrabold tracking-tight text-biblo-charcoal">Explore</h1>
                
                <div class="flex gap-3 overflow-x-auto no-scrollbar pb-2">
                    <button class="bg-biblo-charcoal text-white px-6 py-2 rounded-full text-xs font-bold whitespace-nowrap">Semua</button>
                    <button class="bg-white text-biblo-charcoal/60 border border-biblo-greige/20 px-6 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-biblo-oat transition-colors">Terpopuler</button>
                    <button class="bg-white text-biblo-charcoal/60 border border-biblo-greige/20 px-6 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-biblo-oat transition-colors">Terbaru</button>
                    <button class="bg-white text-biblo-charcoal/60 border border-biblo-greige/20 px-6 py-2 rounded-full text-xs font-bold whitespace-nowrap hover:bg-biblo-oat transition-colors">Gratis</button>
                </div>
            </div>
        </section>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-xl">Recommended For You</h3>
                <a href="#" class="text-xs font-bold text-biblo-moss uppercase tracking-widest hover:underline">See All</a>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach(range(1, 5) as $i)
                <div class="group cursor-pointer">
                    <div class="aspect-[3/4] bg-biblo-greige rounded-[2.5rem] mb-4 overflow-hidden shadow-md group-hover:shadow-2xl transition-all duration-500 relative">
                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md p-2 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity">
                            🔖
                        </div>
                    </div>
                    <h5 class="font-bold text-sm truncate px-2">The Psychology of Money</h5>
                    <p class="text-xs text-biblo-charcoal/40 px-2 mt-1">Morgan Housel</p>
                </div>
                @endforeach
            </div>
        </section>

<section class="relative overflow-hidden rounded-[40px] bg-[#3F453F] p-10 md:p-14 shadow-2xl">
    <div class="pointer-events-none absolute -right-6 -top-6 select-none text-9xl font-black text-white/[0.03]">
        GENRE
    </div>

    <div class="relative z-10">
        <div class="mb-10 text-center md:text-left">
            <h3 class="text-2xl font-bold text-white">Browse by Genre</h3>
            <p class="text-white/40 text-sm">Temukan bacaan yang sesuai dengan minat spesifikmu.</p>
        </div>

        <div class="flex flex-wrap justify-center md:justify-start gap-4">
            @php
                $genres = [
                    ['name' => 'Self Development', 'icon' => '🌱'],
                    ['name' => 'Business', 'icon' => '💼'],
                    ['name' => 'Fiction', 'icon' => '🎭'],
                    ['name' => 'History', 'icon' => '📜'],
                    ['name' => 'Technology', 'icon' => '💻'],
                    ['name' => 'Science', 'icon' => '🔬'],
                    ['name' => 'Psychology', 'icon' => '🧠'],
                    ['name' => 'Philosophy', 'icon' => '🏛️']
                ];
            @endphp

            @foreach($genres as $genre)
                <button class="group flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-6 py-3.5 text-sm font-bold text-white transition-all hover:bg-[#9FAF9A] hover:text-[#3F453F] hover:border-[#9FAF9A] hover:shadow-xl hover:shadow-[#9FAF9A]/20">
                    <span class="text-lg grayscale group-hover:grayscale-0 transition-all">{{ $genre['icon'] }}</span>
                    <span>{{ $genre['name'] }}</span>
                </button>
            @endforeach
        </div>
    </div>
</section>

        <section>
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-xl">Popular This Week</h3>
                <div class="flex gap-2">
                    <button class="p-2 border border-biblo-greige/20 rounded-xl hover:bg-white transition-all text-biblo-greige hover:text-biblo-charcoal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                    </button>
                    <button class="p-2 border border-biblo-greige/20 rounded-xl hover:bg-white transition-all text-biblo-charcoal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @foreach(range(1, 5) as $i)
                <div class="group cursor-pointer">
                    <div class="aspect-[3/4] bg-biblo-greige rounded-[2.5rem] mb-4 overflow-hidden shadow-md group-hover:shadow-xl transition-all relative">
                        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?q=80&w=2112&auto=format&fit=crop" class="w-full h-full object-cover transition-all group-hover:scale-105">
                    </div>
                    <h5 class="font-bold text-sm truncate px-2 text-biblo-charcoal">Atomic Habits</h5>
                    <p class="text-xs text-biblo-charcoal/40 px-2 mt-1">James Clear</p>
                </div>
                @endforeach
            </div>
        </section>

        <section class="pb-10">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-xl">New Arrivals</h3>
                <a href="#" class="text-xs font-bold text-biblo-moss uppercase tracking-widest hover:underline">View More</a>
            </div>
            <div class="flex lg:grid lg:grid-cols-5 gap-6 overflow-x-auto no-scrollbar">
                @foreach(range(1, 5) as $i)
                <div class="w-44 lg:w-full flex-shrink-0 group cursor-pointer">
                    <div class="aspect-[3/4] bg-biblo-greige rounded-[2rem] mb-4 overflow-hidden shadow-md group-hover:shadow-xl transition-all relative">
                        <img src="https://images.unsplash.com/photo-1543004218-ee141104308e?q=80&w=1974&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        <div class="absolute bottom-4 left-4">
                            <span class="bg-biblo-moss text-white text-[8px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-lg">New</span>
                        </div>
                    </div>
                    <h5 class="font-bold text-sm truncate px-2 text-biblo-charcoal">The Midnight Library</h5>
                    <p class="text-xs text-biblo-charcoal/40 px-2 mt-1">Matt Haig</p>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</x-app-layout>
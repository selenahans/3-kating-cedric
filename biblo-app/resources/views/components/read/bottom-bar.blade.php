@props(['prevUrl' => '#', 'nextUrl' => '#', 'progress' => 0])

<nav
    class="fixed bottom-0 inset-x-0 z-50 
    bg-[#FDFBF8] theme-dark:bg-biblo-dark-surface 
    border-t border-biblo-greige/20 theme-dark:border-white/10 
    shadow-[0_-10px_50px_-12px_rgba(63,69,63,0.08)] theme-dark:shadow-none
    transition-colors duration-300">

    <div class="max-w-4xl mx-auto px-6 h-24 flex items-center justify-between">

        {{-- PREV --}}
        <a href="{{ $prevUrl }}" id="prev"
            class="group flex items-center gap-3 
                   text-biblo-charcoal/60 theme-dark:text-biblo-dark-text/50 
                   hover:text-biblo-moss theme-dark:hover:text-white 
                   transition-all">

            <span class="text-xl transition-transform group-hover:-translate-x-1">←</span>
            <span class="text-[11px] font-black uppercase tracking-[0.2em]">
                Halaman Sebelumnya
            </span>
        </a>

        {{-- PROGRESS --}}
        <div class="hidden md:flex flex-col items-center gap-2">

            <div class="w-32 h-1 
                bg-biblo-greige/30 theme-dark:bg-white/10 
                rounded-full overflow-hidden">

                <div id="progress-bar"
                    class="h-full bg-biblo-moss theme-dark:bg-biblo-sage 
                           transition-all duration-700 rounded-full"
                    style="width: {{ $progress->progress_percentage ?? 0 }}%">
                </div>
            </div>

            <span id="progress-text"
                class="text-[9px] font-bold uppercase tracking-widest 
                       text-biblo-moss theme-dark:text-biblo-sage">
                {{ $progress->progress_percentage ?? 0 }}% Selesai
            </span>
        </div>

        {{-- NEXT --}}
        <a href="{{ $nextUrl }}" id="next"
            class="group flex items-center gap-3 
                   text-biblo-charcoal/60 theme-dark:text-biblo-dark-text/50 
                   hover:text-biblo-moss theme-dark:hover:text-white 
                   transition-all">

            <span class="text-[11px] font-black uppercase tracking-[0.2em]">
                Halaman Berikutnya
            </span>
            <span class="text-xl transition-transform group-hover:translate-x-1">→</span>
        </a>

    </div>
</nav>
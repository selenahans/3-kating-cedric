@props(['prevUrl' => '#', 'nextUrl' => '#', 'progress' => 0])

<nav class="fixed bottom-0 inset-x-0 z-50 
    bg-[#FDFBF8] dark:bg-biblo-dark-surface 
    border-t border-biblo-greige/20 dark:border-white/10 
    shadow-[0_-10px_50px_-12px_rgba(63,69,63,0.08)] dark:shadow-none
    transition-colors duration-300">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 sm:h-24 flex items-center justify-between">

        {{-- PREV --}}
        <a href="{{ $prevUrl }}" id="prev"
            class="group flex items-center gap-2 sm:gap-3 
                   text-biblo-charcoal/60 dark:text-biblo-dark-text/50 
                   hover:text-biblo-moss dark:hover:text-white 
                   transition-all">

            <span class="text-2xl sm:text-xl font-black transition-transform group-hover:-translate-x-1">
                ←
            </span>

            <span class="hidden sm:block text-[11px] font-black uppercase tracking-[0.2em]">
                Halaman Sebelumnya
            </span>

            <span class="block sm:hidden text-sm font-black">
                Sebelumnya
            </span>
        </a>

        {{-- PROGRESS --}}
        <div class="flex flex-col items-center gap-1 w-20 sm:w-24 md:w-32">

            <div class="w-full h-1
                bg-biblo-greige/30 dark:bg-white/10 
                rounded-full overflow-hidden">

                <div id="progress-bar"
                    class="h-full bg-biblo-moss dark:bg-biblo-sage 
                           transition-all duration-700 rounded-full"
                    style="width: {{ $progress->progress_percentage ?? 0 }}%">
                </div>
            </div>

            <span id="progress-text"
                class="w-full text-center text-[8px] sm:text-[9px] font-bold uppercase tracking-widest 
                       text-biblo-moss dark:text-biblo-sage">
                {{ $progress->progress_percentage ?? 0 }}%
            </span>

        </div>

        {{-- NEXT --}}
        <a href="{{ $nextUrl }}" id="next"
            class="group flex items-center gap-2 sm:gap-3 
                   text-biblo-charcoal/60 dark:text-biblo-dark-text/50 
                   hover:text-biblo-moss dark:hover:text-white 
                   transition-all">

            <span class="hidden sm:block text-[11px] font-black uppercase tracking-[0.2em]">
                Halaman Berikutnya
            </span>

            <span class="block sm:hidden text-sm font-black">
                Berikutnya
            </span>

            <span class="text-2xl sm:text-xl font-black transition-transform group-hover:translate-x-1">
                →
            </span>
        </a>

    </div>
</nav>
@props(['prevUrl' => '#', 'nextUrl' => '#', 'progress' => 0])

<nav class="fixed bottom-0 inset-x-0 z-50 bg-[#FDFBF8] border-t border-biblo-greige/20 shadow-[0_-10px_50px_-12px_rgba(63,69,63,0.08)]">
    <div class="max-w-4xl mx-auto px-6 h-24 flex items-center justify-between">
        
        {{-- ADDED ID="PREV" --}}
        <a href="{{ $prevUrl }}" id="prev" class="group flex items-center gap-3 text-biblo-charcoal/60 hover:text-biblo-moss transition-all">
            <span class="text-xl transition-transform group-hover:-translate-x-1">←</span>
            <span class="text-[11px] font-black uppercase tracking-[0.2em]">Previous Page</span>
        </a>

        <div class="hidden md:flex flex-col items-center gap-2">
            <div class="w-32 h-1 bg-biblo-greige/30 rounded-full overflow-hidden">
                <div id="progress-bar" class="h-full bg-biblo-moss transition-all duration-700 rounded-full" style="width: {{ $progress }}%"></div>
            </div>
            <span id="progress-text" class="text-[9px] font-bold text-biblo-moss uppercase tracking-widest">{{ $progress }}% Completed</span>
        </div>

        {{-- ADDED ID="NEXT" --}}
        <a href="{{ $nextUrl }}" id="next" class="group flex items-center gap-3 text-biblo-charcoal/60 hover:text-biblo-moss transition-all">
            <span class="text-[11px] font-black uppercase tracking-[0.2em]">Next Page</span>
            <span class="text-xl transition-transform group-hover:translate-x-1">→</span>
        </a>
    </div>
</nav>
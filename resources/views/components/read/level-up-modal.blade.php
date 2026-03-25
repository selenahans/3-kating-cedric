<div id="level-up-modal" class="fixed inset-0 z-[110] bg-biblo-charcoal/40 backdrop-blur-sm hidden items-center justify-center px-4" role="dialog" aria-modal="true" aria-labelledby="level-up-title">
    <div class="w-full max-w-sm rounded-3xl bg-white p-7 shadow-2xl border border-biblo-greige/30 text-center">
        <div id="level-up-confetti" class="pointer-events-none absolute inset-0 overflow-hidden"></div>

        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss/70 mb-2">Pet Growth</p>
        <h3 id="level-up-title" class="text-2xl font-extrabold text-biblo-charcoal tracking-tight mb-2">Level Up!</h3>
        <p class="text-sm text-biblo-charcoal/60 mb-5">
            Selamat! <span id="level-up-pet-name" class="font-extrabold text-biblo-charcoal">Pet kamu</span>
            naik dari level <span id="level-up-old" class="font-extrabold text-biblo-clay">1</span>
            ke level <span id="level-up-new" class="font-extrabold text-biblo-moss">2</span>.
        </p>

        <div class="mx-auto w-20 h-20 rounded-3xl bg-biblo-oat flex items-center justify-center text-4xl mb-5 animate-pulse">
            ✨
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
            <button id="level-up-continue-reading" type="button" class="w-full rounded-2xl bg-biblo-oat text-biblo-charcoal py-3 text-xs font-black uppercase tracking-[0.12em] hover:bg-biblo-greige/50 transition-colors">
                Lanjut Baca
            </button>
            <button id="level-up-view-pet" type="button" class="w-full rounded-2xl bg-biblo-charcoal text-white py-3 text-xs font-black uppercase tracking-[0.15em] hover:bg-black transition-colors">
                Lihat Pet Kamu
            </button>
        </div>
    </div>
</div>

<style>
    .biblo-confetti-piece {
        position: absolute;
        top: -10%;
        border-radius: 999px;
        opacity: 0.85;
        animation-name: biblo-confetti-fall;
        animation-timing-function: cubic-bezier(0.2, 0.9, 0.3, 1);
        animation-fill-mode: forwards;
        will-change: transform, opacity;
    }

    @keyframes biblo-confetti-fall {
        0% {
            transform: translate3d(0, -6px, 0) rotate(0deg);
            opacity: 0;
        }

        15% {
            opacity: 0.85;
        }

        100% {
            transform: translate3d(var(--dx, 0px), 150px, 0) rotate(var(--rot, 120deg));
            opacity: 0;
        }
    }
</style>

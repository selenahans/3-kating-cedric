<x-app-layout title="My Pet" active="pet">
    <div class="max-w-5xl mx-auto space-y-8 md:space-y-10">

        <header class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-biblo-moss mb-1">Companion Status</p>
                <h1 class="text-4xl font-extrabold text-biblo-charcoal tracking-tighter">Meet, <span
                    class="text-biblo-clay">{{ $currentPetName ?? 'Barnaby' }}</span></h1>
            </div>
            <div class="flex flex-wrap gap-3 w-full md:w-auto">
                <a
                    class="bg-white border border-biblo-greige/30 px-5 sm:px-6 py-3 rounded-2xl shadow-sm flex items-center gap-2 hover:bg-biblo-oat transition-all group">
                    <span class="text-lg group-hover:rotate-12 transition-transform">📚</span>
                    <span class="text-xs font-black text-biblo-charcoal uppercase tracking-widest">Library</span>
                </a>
                <div class="bg-white border border-biblo-greige/30 px-5 sm:px-6 py-3 rounded-2xl shadow-sm">
                    <p class="text-[9px] font-black text-biblo-charcoal/40 uppercase tracking-widest">Growth Level</p>
                    <p class="text-xl font-extrabold text-biblo-charcoal">Lv. {{ $petLevel ?? 1 }} <span
                            class="text-xs font-bold text-biblo-moss ml-1">{{ $growthTitle ?? 'Baby' }}</span></p>
                </div>
            </div>
        </header>

<section class="relative bg-biblo-oat rounded-[32px] sm:rounded-[44px] md:rounded-[60px] min-h-[32rem] md:min-h-0 md:aspect-[21/9] overflow-hidden flex flex-col items-center justify-center border border-biblo-greige/20 shadow-inner p-4 sm:p-6 md:p-8">
    <div class="absolute top-10 left-10 w-32 h-32 bg-biblo-sage/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 right-20 w-48 h-48 bg-biblo-clay/10 rounded-full blur-3xl"></div>

    <div class="relative flex flex-col items-center group mb-8 md:mb-20">
        <div class="absolute -bottom-2 w-24 h-4 bg-biblo-charcoal/10 rounded-[100%] blur-md group-hover:scale-110 transition-transform duration-700"></div>

        <div class="w-32 h-32 md:w-40 md:h-40 animate-bounce-slow cursor-pointer hover:scale-110 transition-transform duration-500 flex items-center justify-center relative z-10">
            <img src="{{ $petImage ?? asset('images/boo-pet.webp') }}" alt="{{ $currentPetName ?? 'Pet' }}" class="w-full h-full object-contain">
        </div>

        <div class="absolute -top-12 left-1/2 -translate-x-1/2 whitespace-nowrap bg-white/80 backdrop-blur-md border border-white/50 px-3 sm:px-4 py-1.5 rounded-2xl shadow-sm opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
            <p class="text-[9px] sm:text-[10px] font-black text-biblo-charcoal uppercase tracking-tighter">
                "Sudah baca apa hari ini?"
            </p>
            <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-2 h-2 bg-white/80 rotate-45 border-r border-b border-white/50"></div>
        </div>
    </div>

    <div class="mt-6 w-full grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3 md:absolute md:bottom-6 md:left-6 md:right-6 md:w-auto">
        @foreach(($petStats ?? []) as $stat)
            <div class="relative bg-white/40 backdrop-blur-md border border-white/60 p-2.5 sm:p-3 md:p-4 rounded-[1.25rem] sm:rounded-[2rem] shadow-sm flex flex-col justify-between">
                <div class="flex justify-between items-center mb-2">
                    <div class="flex items-center gap-1.5">
                        <p class="text-[9px] font-black text-biblo-charcoal/40 uppercase tracking-widest">{{ $stat['label'] }}</p>
                        <button type="button"
                            class="w-4 h-4 rounded-full border border-biblo-charcoal/20 bg-white/70 text-[9px] leading-none font-black text-biblo-charcoal/60 hover:bg-white"
                            data-stat-info-toggle
                            data-target-id="stat-info-{{ $loop->index }}"
                            aria-expanded="false"
                            aria-controls="stat-info-{{ $loop->index }}"
                            title="Info {{ $stat['label'] }}">
                            i
                        </button>
                    </div>
                    <p class="text-[10px] font-bold text-biblo-charcoal" @if($stat['label'] === 'Kenyang') id="kenyang-value" @endif>{{ $stat['val'] }}</p>
                </div>
                <div class="w-full bg-biblo-charcoal/5 h-1.5 rounded-full overflow-hidden">
                    <div class="{{ $stat['color'] }} h-full rounded-full transition-all duration-1000" @if($stat['label'] === 'Kenyang') id="kenyang-bar" @endif
                        style="width: {{ $stat['width'] }}"></div>
                </div>
                <div id="stat-info-{{ $loop->index }}" data-stat-info-panel class="hidden absolute z-30 bottom-full mb-2 left-2 right-2 p-2 rounded-xl bg-white border border-white/90 shadow-lg">
                    @php
                        $label = strtolower($stat['label']);
                        $statInfoText = match ($label) {
                            'kenyang' => 'Jika tingkat kekenyangan di bawah 30%, pet tidak bisa membaca buku lagi sampai diberi makan.',
                            'exp' => 'EXP digunakan untuk naik ke level selanjutnya. Semakin penuh bar EXP, semakin dekat ke level berikutnya.',
                            'happiness' => 'Jika membaca buku dengan genre yang sama terus-menerus, happiness akan menurun.',
                            'knowledge' => 'Jika kehilangan streak membaca, knowledge akan berkurang sebesar 20%.',
                            default => 'Informasi untuk stat ini akan diisi nanti.',
                        };
                    @endphp
                    <p class="text-[10px] font-bold text-biblo-charcoal/70">{{ $statInfoText }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

            <div class="lg:col-span-2 space-y-4">
                <h3 class="text-lg font-extrabold text-biblo-charcoal px-2">Growth Quests</h3>
                <div class="px-2">
                    <p class="text-[11px] font-bold text-biblo-charcoal/50">
                        Gate Lv. {{ $nextGateLevel }} - <span id="gate-progress-text">{{ $gateCompletedCount }}/{{ $gateTotalCount }}</span> task selesai
                    </p>
                </div>

                <div class="space-y-3">
                    @forelse(($gateTasks ?? []) as $task)
                        <div class="bg-white p-4 sm:p-5 rounded-[24px] sm:rounded-[32px] border border-biblo-greige/20 flex flex-col sm:flex-row sm:items-center justify-between gap-4 {{ $task['completed'] ? 'opacity-70' : 'group hover:shadow-xl hover:shadow-biblo-sage/5' }} transition-all"
                            data-task-card data-task-id="{{ $task['id'] }}" data-task-completed="{{ $task['completed'] ? '1' : '0' }}">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-xl {{ $task['completed'] ? 'bg-biblo-sage/15' : 'bg-biblo-clay/10' }}">📋</div>
                                <div>
                                    <h4 class="font-bold text-sm text-biblo-charcoal">{{ $task['title'] }}</h4>
                                    <p class="text-[11px] text-biblo-charcoal/50 font-bold">{{ $task['description'] }}</p>
                                    <p class="text-[10px] text-biblo-moss font-black mt-1">+{{ $task['coin_reward'] }} coins & +{{ $task['xp_reward'] }} xp</p>
                                </div>
                            </div>

                            @if($task['completed'])
                                <div class="text-biblo-moss text-xs font-black self-start sm:self-auto" data-task-status>COMPLETED ✅</div>
                            @else
                                <button type="button" data-complete-task data-task-id="{{ $task['id'] }}"
                                    class="w-full sm:w-auto bg-biblo-charcoal text-white text-[10px] font-black px-6 py-2.5 rounded-xl hover:bg-biblo-moss transition-colors">
                                    COMPLETE
                                </button>
                            @endif
                        </div>
                    @empty
                        <div class="bg-white p-4 sm:p-5 rounded-[24px] sm:rounded-[32px] border border-biblo-greige/20">
                            <p class="text-sm font-bold text-biblo-charcoal/60">Belum ada task untuk gate level berikutnya.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <div
                class="bg-biblo-charcoal rounded-[28px] sm:rounded-[36px] lg:rounded-[45px] p-5 sm:p-6 lg:p-8 text-white relative overflow-hidden flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-extrabold">Pet Treats</h3>
                        <a class="bg-biblo-clay text-white p-2.5 rounded-xl hover:scale-110 transition-all shadow-lg shadow-biblo-clay/20 group"
                            title="Buy more treats">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                                <path d="M3 6h18" />
                                <path d="M16 10a4 4 0 0 1-8 0" />
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <button type="button" data-feed-item="apple"
                            class="bg-white/10 hover:bg-white/20 border border-white/10 p-4 rounded-3xl transition-all flex flex-col items-center gap-2 {{ $appleQty > 0 ? '' : 'opacity-40 cursor-not-allowed' }}"
                            @if($appleQty <= 0) disabled @endif>
                            <span class="text-2xl" @if($appleQty <= 0) style="filter: grayscale(100%);" @endif>🍎</span>
                            <span class="text-[10px] font-black uppercase tracking-tighter">Organic Apple</span>
                            <span class="text-[9px] text-biblo-sage font-bold">Qty: <span id="apple-qty">{{ $appleQty ?? 0 }}</span></span>
                        </button>
                        <button type="button" data-feed-item="honey"
                            class="bg-white/10 hover:bg-white/20 border border-white/10 p-4 rounded-3xl transition-all flex flex-col items-center gap-2 {{ $honeyQty > 0 ? '' : 'opacity-40 cursor-not-allowed' }}"
                            @if($honeyQty <= 0) disabled @endif>
                            <span class="text-2xl" @if($honeyQty <= 0) style="filter: grayscale(100%);" @endif>🍯</span>
                            <span class="text-[10px] font-black uppercase tracking-tighter">Sweet Honey</span>
                            <span class="text-[9px] text-biblo-sage font-bold">Qty: <span id="honey-qty">{{ $honeyQty ?? 0 }}</span></span>
                        </button>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-white/10">
                    <p id="feed-status" class="text-[10px] font-bold text-biblo-sage/80 mb-3 min-h-[14px]"></p>
                    <p class="text-[10px] font-bold text-white/40 leading-relaxed italic mb-4">
                        "Give {{ $currentPetName ?? 'your pet' }} treats earned from finishing book chapters to keep them happy!"
                    </p>
                    <a href="{{ route('shop') }}"
                        class="block text-center bg-white/5 hover:bg-white/10 border border-white/10 py-3 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] transition-all">
                        Go to Shop
                    </a>
                </div>
            </div>

        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('[data-feed-item]');
            const taskButtons = document.querySelectorAll('[data-complete-task]');
            const appleQtyEl = document.getElementById('apple-qty');
            const honeyQtyEl = document.getElementById('honey-qty');
            const feedStatusEl = document.getElementById('feed-status');
            const kenyangValueEl = document.getElementById('kenyang-value');
            const kenyangBarEl = document.getElementById('kenyang-bar');
            const gateProgressTextEl = document.getElementById('gate-progress-text');
            const statInfoToggles = document.querySelectorAll('[data-stat-info-toggle]');
            const statInfoPanels = document.querySelectorAll('[data-stat-info-panel]');

            let currentKenyang = Number((kenyangValueEl?.textContent || '0').replace('%', '').trim()) || 0;

            const updateButtonsState = () => {
                const appleQty = Number(appleQtyEl?.textContent || 0);
                const honeyQty = Number(honeyQtyEl?.textContent || 0);

                buttons.forEach((btn) => {
                    const item = btn.getAttribute('data-feed-item');
                    const outOfStock = (item === 'apple' ? appleQty : honeyQty) <= 0;
                    const full = currentKenyang >= 90;
                    btn.disabled = outOfStock || full;
                    btn.classList.toggle('opacity-50', btn.disabled);
                    btn.classList.toggle('cursor-not-allowed', btn.disabled);
                });
            };

            const setKenyang = (value) => {
                currentKenyang = Math.max(0, Math.min(100, Number(value) || 0));
                if (kenyangValueEl) kenyangValueEl.textContent = currentKenyang + '%';
                if (kenyangBarEl) kenyangBarEl.style.width = currentKenyang + '%';
                updateButtonsState();
            };

            buttons.forEach((button) => {
                button.addEventListener('click', async () => {
                    const item = button.getAttribute('data-feed-item');
                    button.disabled = true;

                    try {
                        const response = await fetch("{{ route('mypet.feed') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ item }),
                        });

                        const payload = await response.json();

                        if (!response.ok || !payload.success) {
                            feedStatusEl.textContent = payload.message || 'Gagal memberi makan pet.';
                            feedStatusEl.classList.remove('text-biblo-sage/80');
                            feedStatusEl.classList.add('text-biblo-clay/90');
                            if (typeof payload.kenyang !== 'undefined') {
                                setKenyang(payload.kenyang);
                            }
                            return;
                        }

                        if (appleQtyEl) appleQtyEl.textContent = String(payload.apple_qty ?? 0);
                        if (honeyQtyEl) honeyQtyEl.textContent = String(payload.honey_qty ?? 0);
                        setKenyang(payload.kenyang ?? currentKenyang);

                        feedStatusEl.textContent = payload.message || 'Pet berhasil diberi makan.';
                        feedStatusEl.classList.remove('text-biblo-clay/90');
                        feedStatusEl.classList.add('text-biblo-sage/80');
                    } catch (error) {
                        feedStatusEl.textContent = 'Terjadi error saat memberi makan.';
                        feedStatusEl.classList.remove('text-biblo-sage/80');
                        feedStatusEl.classList.add('text-biblo-clay/90');
                    } finally {
                        updateButtonsState();
                    }
                });
            });

            const getTaskProgress = () => {
                const cards = document.querySelectorAll('[data-task-card]');
                const total = cards.length;
                const done = Array.from(cards).filter((card) => card.getAttribute('data-task-completed') === '1').length;
                return { done, total };
            };

            const refreshGateProgress = () => {
                if (!gateProgressTextEl) return;
                const progress = getTaskProgress();
                gateProgressTextEl.textContent = `${progress.done}/${progress.total}`;
            };

            const closeAllStatInfoPanels = () => {
                document.querySelectorAll('[data-stat-info-panel]').forEach((panel) => panel.classList.add('hidden'));
                statInfoToggles.forEach((toggle) => toggle.setAttribute('aria-expanded', 'false'));
            };

            statInfoToggles.forEach((toggle) => {
                toggle.addEventListener('click', (event) => {
                    event.stopPropagation();
                    const targetId = toggle.getAttribute('data-target-id');
                    const panel = targetId ? document.getElementById(targetId) : null;
                    if (!panel) return;

                    const willOpen = panel.classList.contains('hidden');
                    closeAllStatInfoPanels();
                    if (willOpen) {
                        panel.classList.remove('hidden');
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                });
            });

            statInfoPanels.forEach((panel) => {
                panel.addEventListener('click', (event) => {
                    event.stopPropagation();
                });
            });

            document.addEventListener('click', () => closeAllStatInfoPanels());
            document.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeAllStatInfoPanels();
                }
            });

            taskButtons.forEach((button) => {
                button.addEventListener('click', async () => {
                    const taskId = button.getAttribute('data-task-id');
                    if (!taskId) return;

                    button.disabled = true;
                    button.classList.add('opacity-60', 'cursor-not-allowed');

                    try {
                        const response = await fetch("{{ route('tasks.complete') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            },
                            body: JSON.stringify({ task_id: Number(taskId) }),
                        });

                        const payload = await response.json();

                        if (!response.ok || !payload.success) {
                            feedStatusEl.textContent = payload.message || 'Gagal menyelesaikan task.';
                            feedStatusEl.classList.remove('text-biblo-sage/80');
                            feedStatusEl.classList.add('text-biblo-clay/90');
                            button.disabled = false;
                            button.classList.remove('opacity-60', 'cursor-not-allowed');
                            return;
                        }

                        const card = document.querySelector(`[data-task-card][data-task-id="${taskId}"]`);
                        if (card) {
                            card.setAttribute('data-task-completed', '1');
                            card.classList.add('opacity-70');
                            card.classList.remove('group');
                        }

                        const completeBadge = document.createElement('div');
                        completeBadge.className = 'text-biblo-moss text-xs font-black self-start sm:self-auto';
                        completeBadge.setAttribute('data-task-status', '1');
                        completeBadge.textContent = 'COMPLETED ✅';
                        button.replaceWith(completeBadge);

                        refreshGateProgress();

                        feedStatusEl.textContent = payload.message || 'Task berhasil diselesaikan.';
                        feedStatusEl.classList.remove('text-biblo-clay/90');
                        feedStatusEl.classList.add('text-biblo-sage/80');
                    } catch (error) {
                        feedStatusEl.textContent = 'Terjadi error saat menyelesaikan task.';
                        feedStatusEl.classList.remove('text-biblo-sage/80');
                        feedStatusEl.classList.add('text-biblo-clay/90');
                        button.disabled = false;
                        button.classList.remove('opacity-60', 'cursor-not-allowed');
                    }
                });
            });

            updateButtonsState();
            refreshGateProgress();
        });
    </script>
</x-app-layout>

@extends('layouts.read')

@section('title', 'Reading: ' . $book->title)

@section('content')

    {{-- Navbar --}}
    <x-read.navbar :title="$book->title" :currentPage="1" :totalPages="($book->total_pages ?? 1)" :backUrl="route('book.detail', $book)" :petImage="$petImage" />

    {{-- Cleaned Content Area --}}
    <main class="pb-44 px-6 bg-biblo-cream/10">
        <div class="max-w-4xl mx-auto">
            {{-- This is the only element ePub.js needs --}}
            <div id="viewer" class="h-[600px] w-full bg-white rounded-lg"></div>

            {{-- Loading State --}}
            <div id="loading" class="text-center py-20 text-biblo-sage font-medium">
                <div class="animate-pulse">Opening "{{ $book->title }}"...</div>
            </div>
        </div>
    </main>

    {{-- Highlight Action Modal --}}
    <div id="highlight-action-modal"
        class="fixed inset-0 z-[95] bg-biblo-charcoal/30 backdrop-blur-sm hidden items-center justify-center px-4">
        <div class="bg-white rounded-3xl p-6 w-full max-w-md shadow-2xl transform transition-all">
            <h3 class="font-bold text-xl text-biblo-charcoal mb-3">Simpan Highlight</h3>
            <p class="text-sm text-biblo-charcoal/60 mb-5">Pilih aksi untuk teks yang kamu highlight.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <button id="highlight-only-btn"
                    class="py-3 rounded-xl font-bold text-sm text-biblo-charcoal bg-biblo-greige/20 hover:bg-biblo-greige/40 transition-all">
                    Highlight Saja
                </button>
                <button id="add-note-btn"
                    class="py-3 rounded-xl font-bold text-sm text-white bg-biblo-moss hover:bg-[#7e8f7a] transition-all">
                    Tambah ke Notes
                </button>
            </div>

            <button id="cancel-action-btn"
                class="w-full mt-3 py-3 rounded-xl font-bold text-sm text-biblo-charcoal/70 hover:text-biblo-charcoal hover:bg-biblo-oat transition-all">
                Batal
            </button>
        </div>
    </div>

    {{-- Note Taking Modal (Hidden by default) --}}
    <div id="note-modal"
        class="fixed inset-0 z-[100] bg-biblo-charcoal/40 backdrop-blur-sm hidden items-center justify-center px-4">
        <div class="bg-white rounded-3xl p-6 w-full max-w-md shadow-2xl transform transition-all">
            <h3 class="font-bold text-xl text-biblo-charcoal mb-4">Add a Note</h3>

            {{-- Shows the text they highlighted --}}
            <div class="bg-biblo-oat/50 p-4 rounded-xl mb-4 border border-biblo-greige/20">
                <p id="highlighted-text-preview" class="text-xs text-biblo-charcoal/60 italic line-clamp-3"></p>
            </div>

            <div class="mb-4">
                <p class="text-sm font-semibold mb-2 text-biblo-charcoal">Highlight Color</p>
                <div class="flex gap-2">
                    <button class="color-btn w-6 h-6 rounded-full bg-yellow-300 border-2 border-transparent"
                        data-color="#FDE047"></button>
                    <button class="color-btn w-6 h-6 rounded-full bg-green-300 border-2 border-transparent"
                        data-color="#86EFAC"></button>
                    <button class="color-btn w-6 h-6 rounded-full bg-blue-300 border-2 border-transparent"
                        data-color="#93C5FD"></button>
                    <button class="color-btn w-6 h-6 rounded-full bg-pink-300 border-2 border-transparent"
                        data-color="#F9A8D4"></button>
                </div>
            </div>
            <textarea id="note-input" rows="4"
                class="w-full bg-biblo-cream/20 border border-biblo-greige/30 rounded-xl p-4 text-sm focus:ring-2 focus:ring-biblo-moss focus:border-biblo-moss transition-all"
                placeholder="Write your thoughts here..."></textarea>

            <div class="flex gap-3 mt-6">
                <button id="cancel-note-btn"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-biblo-charcoal bg-biblo-greige/20 hover:bg-biblo-greige/40 transition-all">Cancel</button>
                <button id="save-note-btn"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-white bg-biblo-moss hover:bg-[#7e8f7a] transition-all">Save
                    Note</button>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <x-read.bottom-bar id="prev" nextId="next" :progress="$progress->progress_percentage ?? 0" />
    
    {{-- Hungry Pet Notification Modal --}}
    <div id="hungry-pet-modal"
        class="fixed inset-0 z-[98] bg-biblo-charcoal/30 backdrop-blur-sm hidden items-center justify-center px-4">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl transform transition-all text-center">
            <div class="text-5xl mb-4">🍽️</div>
            <h3 class="font-bold text-2xl text-biblo-charcoal mb-2">Pet Kamu Lapar!</h3>
            <p class="text-biblo-charcoal/70 mb-6">Pet kamu perlu makan sebelum bisa melanjutkan membaca. Kenyang: <span id="hungry-pet-health" class="font-bold">0</span>%</p>
            <p class="text-sm text-biblo-charcoal/60 mb-6">Kasih makan pet kamu dulu, ya!</p>
            
            <a href="{{ route('mypet') }}" 
                class="w-full py-3 rounded-xl font-bold text-white bg-biblo-moss hover:bg-[#7e8f7a] transition-all inline-block">
                Beri Makan Pet
            </a>
        </div>
    </div>

    {{-- Level Gate Tasks Modal --}}
    <div id="level-gate-modal"
        class="fixed inset-0 z-[98] bg-biblo-charcoal/30 backdrop-blur-sm hidden items-center justify-center px-4 overflow-y-auto">
        <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl transform transition-all my-8">
            <div class="text-4xl mb-4 text-center">📋</div>
            <h3 class="font-bold text-2xl text-biblo-charcoal mb-2 text-center">Selesaikan Tugas Dulu</h3>
            <p class="text-biblo-charcoal/70 mb-6 text-center">Kamu perlu menyelesaikan semua tugas berikut sebelum naik ke level <span id="gate-level" class="font-bold">3</span>:</p>
            
            <div id="tasks-list" class="space-y-3 mb-6 max-h-64 overflow-y-auto">
                <!-- Tasks akan di-populate via JavaScript -->
            </div>

            <div class="flex gap-3">
                <button id="gate-close-btn"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-biblo-charcoal bg-biblo-greige/20 hover:bg-biblo-greige/40 transition-all">
                    Lanjut Baca
                </button>
                <a href="{{ route('mypet') }}"
                    class="flex-1 py-3 rounded-xl font-bold text-sm text-white bg-biblo-moss hover:bg-[#7e8f7a] transition-all text-center">
                    Cek Tugas
                </a>
            </div>
        </div>
    </div>

    <x-read.level-up-modal />

    {{-- ePub.js Library --}}
    <script src="https://cdn.jsdelivr.net/npm/epubjs/dist/epub.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const loading = document.getElementById("loading");
            const viewer = document.getElementById("viewer");

            const url = "{{ asset('storage/' . $book->file_path) }}";
            const savedNotes = @json($notes);
            let selectedColor = "#FDE047"; // default
            const savedCfi = @json($progress->current_location ?? null);

            const totalPages = Math.max(1, Number({{ (int) ($book->total_pages ?? 1) }}));

            let lastSavedProgress = {{ $progress->progress_percentage ?? 0 }};
            let currentProgress = lastSavedProgress;
            let currentTopbarPage = progressToPage(lastSavedProgress);
            let pendingDirection = 0;
            let hasProgressChanged = false;
            let previousDisplayedPage = null;
            let accumulatedPagesRead = 0;
            const levelUpModal = document.getElementById("level-up-modal");
            const levelUpOld = document.getElementById("level-up-old");
            const levelUpNew = document.getElementById("level-up-new");
            const levelUpPetName = document.getElementById("level-up-pet-name");
            const levelUpViewPetBtn = document.getElementById("level-up-view-pet");
            const levelUpContinueReadingBtn = document.getElementById("level-up-continue-reading");
            const levelUpConfetti = document.getElementById("level-up-confetti");
            
            const hungryPetModal = document.getElementById("hungry-pet-modal");
            const hungryPetHealth = document.getElementById("hungry-pet-health");
            
            const levelGateModal = document.getElementById("level-gate-modal");
            const gateCloseBtn = document.getElementById("gate-close-btn");
            const tasksList = document.getElementById("tasks-list");
            const gateLevel = document.getElementById("gate-level");
            const initialHungry = @json($isHungry ?? false);

            function progressToPage(progress) {
                const normalized = Math.min(100, Math.max(0, Number(progress) || 0));
                return Math.min(totalPages, Math.max(1, Math.round((normalized / 100) * totalPages) || 1));
            }

            function setReaderCurrentPage(pageNumber) {
                const readerCurrentPage = document.getElementById("reader-current-page");
                if (!readerCurrentPage) return;
                readerCurrentPage.textContent = String(Math.min(totalPages, Math.max(1, Number(pageNumber) || 1)));
            }

            async function showHungryAndBlockReader(health = null) {
                if (hungryPetHealth && health !== null) {
                    hungryPetHealth.textContent = String(health);
                }
                if (hungryPetModal) {
                    hungryPetModal.classList.remove("hidden");
                    hungryPetModal.classList.add("flex");
                }
                if (viewer) {
                    viewer.classList.add("pointer-events-none", "opacity-60");
                }
                if (loading) {
                    loading.style.display = "none";
                }
            }

            // Check pet status on page load
            async function checkPetStatus() {
                try {
                    const response = await fetch("{{ route('mypet.status') }}", {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error("Failed to fetch pet status");
                    }

                    const data = await response.json();
                    
                    if (data.is_hungry) {
                        // Show hungry pet modal
                        if (hungryPetHealth) {
                            hungryPetHealth.textContent = data.health;
                        }
                        if (hungryPetModal) {
                            hungryPetModal.classList.remove("hidden");
                            hungryPetModal.classList.add("flex");
                        }
                        return true;
                    }
                    return false;
                } catch (error) {
                    console.error("Failed to check pet status:", error);
                    return false;
                }
            }

            function triggerConfettiBurst() {
                if (!levelUpConfetti) return;

                const colors = ["#9FAF9A", "#B09D85", "#CFC8BE", "#7E8F7A"];
                levelUpConfetti.innerHTML = "";

                for (let i = 0; i < 16; i++) {
                    const piece = document.createElement("span");
                    piece.className = "biblo-confetti-piece";

                    const size = 4 + Math.floor(Math.random() * 5);
                    const left = 8 + Math.random() * 84;
                    const dx = -36 + Math.random() * 72;
                    const rot = -180 + Math.random() * 360;
                    const duration = 850 + Math.floor(Math.random() * 500);
                    const delay = Math.floor(Math.random() * 120);

                    piece.style.width = size + "px";
                    piece.style.height = size * 1.6 + "px";
                    piece.style.left = left + "%";
                    piece.style.backgroundColor = colors[i % colors.length];
                    piece.style.setProperty("--dx", dx + "px");
                    piece.style.setProperty("--rot", rot + "deg");
                    piece.style.animationDuration = duration + "ms";
                    piece.style.animationDelay = delay + "ms";

                    levelUpConfetti.appendChild(piece);
                }

                setTimeout(() => {
                    if (levelUpConfetti) {
                        levelUpConfetti.innerHTML = "";
                    }
                }, 1700);
            }

            function showLevelUpModal(oldLevel, newLevel) {
                if (!levelUpModal) return Promise.resolve();

                if (levelUpOld) levelUpOld.textContent = String(oldLevel);
                if (levelUpNew) levelUpNew.textContent = String(newLevel);
                if (levelUpPetName) levelUpPetName.textContent = "{{ $currentPetName ?? 'Pet kamu' }}";

                levelUpModal.classList.remove("hidden");
                levelUpModal.classList.add("flex");
                triggerConfettiBurst();

                return new Promise((resolve) => {
                    let settled = false;
                    const done = (action) => {
                        if (settled) return;
                        settled = true;
                        levelUpModal.classList.add("hidden");
                        levelUpModal.classList.remove("flex");
                        resolve(action);
                    };

                    const cleanupAndDone = (action) => {
                        if (levelUpViewPetBtn && viewPetHandler) {
                            levelUpViewPetBtn.removeEventListener("click", viewPetHandler);
                        }
                        if (levelUpContinueReadingBtn && continueReadingHandler) {
                            levelUpContinueReadingBtn.removeEventListener("click", continueReadingHandler);
                        }
                        done(action);
                    };

                    const viewPetHandler = () => cleanupAndDone("view-pet");
                    const continueReadingHandler = () => cleanupAndDone("continue-reading");

                    if (levelUpViewPetBtn) {
                        levelUpViewPetBtn.addEventListener("click", viewPetHandler);
                    }
                    if (levelUpContinueReadingBtn) {
                        levelUpContinueReadingBtn.addEventListener("click", continueReadingHandler);
                    }
                });
            }

            function calculatePagesRead() {
                const lastPages = Math.round((lastSavedProgress / 100) * totalPages);
                const currentPages = Math.round((currentProgress / 100) * totalPages);

                const percentageBasedPages = Math.max(0, currentPages - lastPages);
                return Math.max(accumulatedPagesRead, percentageBasedPages);
            }

            async function saveReadingLog() {
                const pagesRead = calculatePagesRead();

                if (pagesRead <= 0) return { action: 'none' };

                try {
                    const response = await fetch("{{ route('reading-log.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            book_id: {{ $book->id }},
                            pages_read: pagesRead
                        })
                    });

                    const payload = await response.json();

                    if (!response.ok && payload?.hungry_blocked) {
                        isHungryNow = true;
                        await showHungryAndBlockReader(payload?.health ?? null);
                        return { action: 'none' };
                    }

                    // Handle level gate blocked
                    if (!response.ok && payload?.level_blocked) {
                        showLevelGateModal(payload.level_gate_info);
                        return { action: 'none' };
                    }

                    if (!response.ok) {
                        throw new Error("Failed to persist reading log");
                    }

                    let action = 'none';
                    if (payload?.leveled_up) {
                        action = await showLevelUpModal(payload.old_level, payload.new_level);
                    }

                    // Reset accumulator after successful save to avoid duplicate logs.
                    accumulatedPagesRead = 0;
                    lastSavedProgress = currentProgress;
                    hasProgressChanged = false;

                    return { action };
                } catch (error) {
                    console.error("Failed to save reading log:", error);
                    return { action: 'none' };
                }
            }

            function showLevelGateModal(gateInfo) {
                if (!levelGateModal || !tasksList) return;

                gateLevel.textContent = gateInfo.level_gate;
                tasksList.innerHTML = '';

                gateInfo.incomplete_tasks.forEach((task, index) => {
                    const taskEl = document.createElement('div');
                    taskEl.className = 'bg-biblo-oat/20 p-3 rounded-xl flex gap-3';
                    taskEl.innerHTML = `
                        <div class="flex-shrink-0 w-6 h-6 rounded-full bg-biblo-clay/20 flex items-center justify-center">
                            <span class="text-xs font-black">${index + 1}</span>
                        </div>
                        <div class="flex-1 text-left">
                            <p class="font-bold text-xs text-biblo-charcoal">${task.title}</p>
                            <p class="text-[10px] text-biblo-charcoal/60">${task.description}</p>
                        </div>
                    `;
                    tasksList.appendChild(taskEl);
                });

                levelGateModal.classList.remove('hidden');
                levelGateModal.classList.add('flex');
            }

            if (gateCloseBtn) {
                gateCloseBtn.addEventListener('click', function() {
                    levelGateModal.classList.add('hidden');
                    levelGateModal.classList.remove('flex');
                });
            }

            const backBtn = document.querySelector('#back-btn');

            if (backBtn) {
                backBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    console.log("BACK DIKLIK");

                    if (hasProgressChanged) {
                        console.log("ADA PERUBAHAN");

                        saveReadingLog()
                            .then((result) => {
                                if (result?.action === 'view-pet') {
                                    window.location.href = "{{ route('mypet') }}";
                                    return;
                                }

                                if (result?.action === 'continue-reading') {
                                    return;
                                }

                                window.location.href = backBtn.href;
                            })
                            .catch((err) => {
                                console.error("ERROR SAVE:", err);
                                window.location.href = backBtn.href; // tetap redirect walau error
                            });

                    } else {
                        console.log("TIDAK ADA PERUBAHAN");
                        window.location.href = backBtn.href;
                    }
                });
            }

            if (initialHungry) {
                showHungryAndBlockReader();
                return;
            }

            let isHungryNow = false;
            checkPetStatus().then((hungry) => {
                if (hungry) {
                    isHungryNow = true;
                    showHungryAndBlockReader();
                }
            });

            // Periodic pet health check every 5 seconds during active reading
            const petHealthCheckInterval = setInterval(async () => {
                if (isHungryNow) {
                    // Already blocked, no need to check again
                    return;
                }

                try {
                    const response = await fetch("{{ route('mypet.status') }}", {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        }
                    });

                    if (!response.ok) {
                        return;
                    }

                    const data = await response.json();

                    if (data.is_hungry && !isHungryNow) {
                        isHungryNow = true;
                        await showHungryAndBlockReader(data.health);
                        console.log("Pet became hungry during reading, blocking reader");
                    }
                } catch (error) {
                    console.error("Failed to check pet health periodically:", error);
                }
            }, 5000);

            let book = ePub(url);
            let rendition = book.renderTo("viewer", {
                width: "100%",
                height: "100%",
                flow: "paginated",
                spread: "none",
                allowScriptedContent: true
            });

            book.ready.then(async () => {
                await book.locations.generate(1000); // 🔥 THIS FIXES EVERYTHING

                // Keep topbar in sync before first relocated event fires.
                setReaderCurrentPage(currentTopbarPage);

                try {
                    if (savedCfi) {
                        await rendition.display(savedCfi); // 🔥 resume
                    } else {
                        await rendition.display();
                    }
                } catch (e) {
                    console.warn("Invalid CFI, trying progress-based resume", e);

                    const resumeProgress = Math.min(99, Math.max(0, Number(lastSavedProgress) || 0));
                    const fallbackCfi = book.locations.cfiFromPercentage(resumeProgress / 100);

                    if (fallbackCfi) {
                        await rendition.display(fallbackCfi);
                    } else {
                        await rendition.display();
                    }
                }

                loading.style.display = "none";
                registerHighlightHandler();
            });

            function updateProgressUI(location) {
                const percentage = book.locations
                    ? book.locations.percentageFromCfi(location.start.cfi)
                    : 0;
                const progress = Math.round(percentage * 100);
                const mappedPage = progressToPage(progress);

                if (pendingDirection !== 0) {
                    const step = pendingDirection > 0 ? 1 : -1;
                    currentTopbarPage = Math.min(totalPages, Math.max(1, currentTopbarPage + step));
                    pendingDirection -= step;

                    // Hard resync only when drift is clearly off.
                    if (Math.abs(mappedPage - currentTopbarPage) >= 8) {
                        currentTopbarPage = mappedPage;
                        pendingDirection = 0;
                    }
                } else {
                    // Initial/direct jumps should still reflect persisted progress.
                    currentTopbarPage = mappedPage;
                }

                const progressBar = document.getElementById("progress-bar");
                const progressText = document.getElementById("progress-text");

                if (progressBar) {
                    progressBar.style.width = progress + "%";
                }

                if (progressText) {
                    progressText.textContent = progress + "% Completed";
                }

                setReaderCurrentPage(currentTopbarPage);
            }

            rendition.on("rendered", () => {
                loadSavedHighlights(); // 🔥 THIS WAS MISSING
            });

            function loadSavedHighlights() {
                if (!rendition || !savedNotes) return;

                savedNotes.forEach(note => {
                    if (!note.cfi_range) return;

                    const type = "hl-" + (note.color_code || "#FDE047").replace('#', '');

                    rendition.annotations.highlight(
                        note.cfi_range,
                        {},
                        (e) => {
                            alert(note.note_content || "No note");
                        },
                        type,
                        {
                            fill: note.color_code || "#FDE047",
                            "fill-opacity": "0.4"
                        }
                    );
                });
            }


            // --- Navigation (WITH PRE-FLIGHT PET HEALTH CHECK) ---
            document.getElementById("next").onclick = (e) => {
                e.preventDefault();
                if (isHungryNow) {
                    showHungryAndBlockReader();
                    return;
                }

                // Pre-flight check before next to catch any state change
                checkPetStatus().then((hungry) => {
                    if (hungry && !isHungryNow) {
                        isHungryNow = true;
                        showHungryAndBlockReader();
                        return;
                    }
                    pendingDirection += 1;
                    rendition.next();
                });
            };

            document.getElementById("prev").onclick = (e) => {
                e.preventDefault();
                if (isHungryNow) {
                    showHungryAndBlockReader();
                    return;
                }

                // Pre-flight check before prev to catch any state change
                checkPetStatus().then((hungry) => {
                    if (hungry && !isHungryNow) {
                        isHungryNow = true;
                        showHungryAndBlockReader();
                        return;
                    }
                    pendingDirection -= 1;
                    rendition.prev();
                });
            };

            document.querySelectorAll('.color-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedColor = btn.dataset.color;

                    // UI feedback (border highlight)
                    document.querySelectorAll('.color-btn').forEach(b => {
                        b.classList.remove('border-black');
                    });

                    btn.classList.add('border-black');
                });
            });

            rendition.on("relocated", async function (location) {
                updateProgressUI(location);

                const displayedPage = Number(location?.start?.displayed?.page ?? 0);
                if (Number.isFinite(displayedPage) && displayedPage > 0) {
                    if (previousDisplayedPage !== null && displayedPage > previousDisplayedPage) {
                        accumulatedPagesRead += (displayedPage - previousDisplayedPage);
                    }
                    previousDisplayedPage = displayedPage;
                }

                const percentage = book.locations
                    ? book.locations.percentageFromCfi(location.start.cfi)
                    : 0;

                const progress = Math.round(percentage * 100);

                currentProgress = progress;

                hasProgressChanged = true;

                try {
                    await fetch("{{ route('reading.update-progress', $book) }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            current_location: location.start.cfi,
                            progress_percentage: progress
                        })
                    });
                } catch (error) {
                    console.error("Progress save failed:", error);
                }
            });

            // Fallback when user leaves page without clicking custom back button.
            window.addEventListener("pagehide", function () {
                const pagesRead = calculatePagesRead();
                if (!hasProgressChanged || pagesRead <= 0) return;

                fetch("{{ route('reading-log.store') }}", {
                    method: "POST",
                    keepalive: true,
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute('content')
                    },
                    body: JSON.stringify({
                        book_id: {{ $book->id }},
                        pages_read: pagesRead
                    })
                });
            });


            // --- HIGHLIGHT & NOTES LOGIC (NEW) ---
            let currentSelection = null;
            const noteModal = document.getElementById('note-modal');
            const noteInput = document.getElementById('note-input');
            const highlightPreview = document.getElementById('highlighted-text-preview');

            function registerHighlightHandler() {
                if (!rendition) return;

                rendition.on("selected", function (cfiRange, contents) {
                    book.getRange(cfiRange).then(function (range) {
                        const selectedText = range.toString();

                        if (selectedText.trim() !== "") {
                            currentSelection = {
                                cfiRange: cfiRange,
                                text: selectedText
                            };

                            highlightPreview.innerText = `"${selectedText}"`;
                            noteModal.classList.remove('hidden');
                            noteModal.classList.add('flex');
                        }
                    });
                });
            }

            // Cancel note
            document.getElementById('cancel-note-btn').onclick = function () {
                noteModal.classList.add('hidden');
                noteModal.classList.remove('flex');
                noteInput.value = "";
                currentSelection = null;

                if (rendition) {
                    rendition.getContents().forEach(c =>
                        c.window.getSelection().removeAllRanges()
                    );
                }
            };

            // Save note
            document.getElementById('save-note-btn').onclick = async function () {
                if (!currentSelection) return;

                const cfi = currentSelection.cfiRange;
                const text = currentSelection.text;

                if (rendition) {
                    rendition.getContents().forEach(c =>
                        c.window.getSelection().removeAllRanges()
                    );
                }

                const noteContent = noteInput.value;
                const type = "hl-" + selectedColor.replace('#', '');

                rendition.annotations.remove(cfi);

                rendition.annotations.highlight(
                    cfi,
                    {},
                    null,
                    type,
                    {
                        fill: selectedColor,
                        "fill-opacity": "0.4"
                    }
                );

                try {
                    await fetch("{{ route('notes.store') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            book_id: {{ $book->id }},
                            cfi_range: cfi,
                            highlighted_text: text,
                            note_content: noteContent,
                            color_code: selectedColor
                        })
                    });
                } catch (error) {
                    console.error("Failed to save note:", error);
                }

                currentSelection = null;
                noteModal.classList.add('hidden');
                noteModal.classList.remove('flex');
                noteInput.value = "";
            };
        });
        
       

        

    </script>
@endsection
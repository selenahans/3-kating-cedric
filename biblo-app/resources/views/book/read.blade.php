@extends('layouts.read')

@section('title', 'Reading: ' . $book->title)

@section('content')

    {{-- Navbar --}}
    <x-read.navbar :title="$book->title" :currentPage="1" :totalPages="$book->total_pages" :backUrl="route('book.detail', $book)" />

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

            const totalPages = {{ $book->total_pages }};

            let lastSavedProgress = {{ $progress->progress_percentage ?? 0 }};
            let currentProgress = lastSavedProgress;
            let hasProgressChanged = false;

             function calculatePagesRead() {
                const lastPages = Math.round((lastSavedProgress / 100) * totalPages);
                const currentPages = Math.round((currentProgress / 100) * totalPages);

                return Math.max(0, currentPages - lastPages);
            }
            async function saveReadingLog() {
                console.log("SAVE READING LOG DIPANGGIL"); // 🔥 DEBUG

                const pagesRead = calculatePagesRead();

                console.log("pagesRead:", pagesRead); // 🔥 DEBUG

                if (pagesRead <= 0) return;

                try {
                    await fetch("{{ route('reading-log.store') }}", {
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

                    console.log("SUCCESS SIMPAN"); // 🔥 DEBUG
                } catch (error) {
                    console.error("Failed to save reading log:", error);
                }
            }

            const backBtn = document.querySelector('#back-btn');

            if (backBtn) {
                backBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    console.log("BACK DIKLIK");

                    if (hasProgressChanged) {
                        console.log("ADA PERUBAHAN");

                        saveReadingLog()
                            .then(() => {
                                console.log("SELESAI SAVE");
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

                try {
                    if (savedCfi) {
                        await rendition.display(savedCfi); // 🔥 resume
                    } else {
                        await rendition.display();
                    }
                } catch (e) {
                    console.warn("Invalid CFI, fallback to start");
                    await rendition.display();
                }

                loading.style.display = "none";
                registerHighlightHandler();
            });

            function updateProgressUI(location) {
                const current = location.start.displayed.page;
                const percentage = book.locations
                    ? book.locations.percentageFromCfi(location.start.cfi)
                    : 0;
                const progress = Math.round(percentage * 100);

                const progressBar = document.getElementById("progress-bar");
                const progressText = document.getElementById("progress-text");

                if (progressBar) {
                    progressBar.style.width = progress + "%";
                }

                if (progressText) {
                    progressText.textContent = progress + "% Completed";
                }

                document.getElementById("reader-current-page").textContent = current;
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


            // --- Navigation (OLD SIMPLE VERSION) ---
            document.getElementById("next").onclick = (e) => {
                e.preventDefault();
                rendition.next();
            };

            document.getElementById("prev").onclick = (e) => {
                e.preventDefault();
                rendition.prev();
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
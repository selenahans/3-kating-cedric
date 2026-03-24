@extends('layouts.read')

@section('title', 'Reading: ' . $book->title)

@section('content')

    {{-- Navbar --}}
    <x-read.navbar :title="$book->title" :currentPage="$currentDummyPage" :totalPages="$dummyTotalPages"
        :backUrl="route('book.detail', $book)" />

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
            const totalDummyPages = {{ $dummyTotalPages }};
            let currentDummyPage = {{ $currentDummyPage }};
            const bookSourceUrl = @json($bookSourceUrl);
            let epubBook = null;
            let rendition = null;
            let isDummyMode = false;

            const DUMMY_PAGES = [
                "Di awal cerita, suasana diperkenalkan perlahan dan tokoh utama mulai tampil dengan konflik kecil yang memancing rasa penasaran.",
                "Relasi antar tokoh mulai terbentuk. Masing-masing karakter menunjukkan sikap yang berbeda dan menambah ketegangan cerita.",
                "Bab ini memperlihatkan perubahan sudut pandang tokoh terhadap keadaan sekitarnya, membuat alur terasa semakin hidup.",
                "Konflik utama mulai terlihat jelas. Pilihan yang diambil tokoh memunculkan konsekuensi yang tidak terduga.",
                "Cerita bergerak lebih cepat. Tokoh utama menghadapi tantangan emosional sekaligus sosial yang menguji prinsipnya.",
                "Nuansa narasi menjadi lebih dalam dengan dialog-dialog penting yang mengubah hubungan antar tokoh.",
                "Puncak ketegangan mulai terasa. Keputusan besar diambil dan efeknya mulai menyebar ke semua karakter.",
                "Setelah konflik memuncak, cerita memberi ruang refleksi dan memperlihatkan perkembangan karakter secara signifikan.",
                "Bab mendekati akhir mempertemukan kembali benang-benang cerita yang sebelumnya terpisah.",
                "Penutup membawa resolusi yang kuat. Perjalanan tokoh terasa utuh dengan makna yang lebih matang."
            ];

            function clampPage(page) {
                return Math.max(1, Math.min(totalDummyPages, page));
            }

            function updateProgressUI(page) {
                const safePage = clampPage(page);
                const progress = Math.round((safePage / totalDummyPages) * 100);

                const progressBar = document.getElementById('progress-bar');
                const progressText = document.getElementById('progress-text');
                const pageText = document.getElementById('reader-current-page');

                if (progressBar) progressBar.style.width = `${progress}%`;
                if (progressText) progressText.textContent = `${progress}% Completed`;
                if (pageText) pageText.textContent = String(safePage);
            }

            async function persistProgress(page) {
                try {
                    await fetch("{{ route('reading.update-progress', $book) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            page: clampPage(page),
                            current_location: String(clampPage(page))
                        })
                    });
                } catch (error) {
                    console.error('Failed to update progress:', error);
                }
            }

            function renderDummyPage(page) {
                const safePage = clampPage(page);
                const pageText = DUMMY_PAGES[safePage - 1] ?? DUMMY_PAGES[0];

                viewer.innerHTML = `
                    <article class="h-full w-full overflow-y-auto p-8 sm:p-10 text-biblo-charcoal">
                        <h2 class="text-2xl font-extrabold mb-6">${@json($book->title)} - Page ${safePage}</h2>
                        <p class="text-base leading-8 mb-6">${pageText}</p>
                        <p class="text-base leading-8">Ini adalah konten bacaan dummy agar reader tetap bisa dipakai saat file EPUB asli belum tersedia di server.</p>
                    </article>
                `;
            }

            function registerDummyHighlightHandler() {
                if (!viewer) return;

                viewer.onmouseup = function () {
                    if (!isDummyMode) return;

                    const selection = window.getSelection();
                    const selectedText = selection ? selection.toString().trim() : '';

                    if (selectedText === '') return;

                    currentSelection = {
                        cfi: `dummy-page-${currentDummyPage}-${Date.now()}`,
                        text: selectedText
                    };

                    highlightPreview.innerText = `"${selectedText}"`;
                    openActionModal();
                };
            }

            function activateDummyReader() {
                isDummyMode = true;
                loading.style.display = "none";
                currentDummyPage = clampPage(currentDummyPage);
                renderDummyPage(currentDummyPage);
                registerDummyHighlightHandler();
                updateProgressUI(currentDummyPage);
                persistProgress(currentDummyPage);
            }

            async function initReader() {
                if (!bookSourceUrl) {
                    activateDummyReader();
                    return;
                }

                try {
                    epubBook = ePub(bookSourceUrl);
                    rendition = epubBook.renderTo("viewer", {
                        width: "100%",
                        height: "100%",
                        flow: "paginated",
                        spread: "none",
                        allowScriptedContent: true
                    });

                    rendition.display();

                    await epubBook.ready;
                    loading.style.display = "none";
                    updateProgressUI(currentDummyPage);
                    registerHighlightHandler();
                } catch (error) {
                    console.error('EPUB failed to load, switching to dummy reader:', error);
                    activateDummyReader();
                }
            }

            initReader();

            document.getElementById("next").onclick = async (event) => {
                event.preventDefault();
                currentDummyPage = clampPage(currentDummyPage + 1);

                if (!isDummyMode && rendition) {
                    rendition.next();
                } else {
                    renderDummyPage(currentDummyPage);
                }

                updateProgressUI(currentDummyPage);
                await persistProgress(currentDummyPage);
            };

            document.getElementById("prev").onclick = async (event) => {
                event.preventDefault();
                currentDummyPage = clampPage(currentDummyPage - 1);

                if (!isDummyMode && rendition) {
                    rendition.prev();
                } else {
                    renderDummyPage(currentDummyPage);
                }

                updateProgressUI(currentDummyPage);
                await persistProgress(currentDummyPage);
            };

            // --- HIGHLIGHT & NOTES LOGIC ---

            let currentSelection = null;
            const highlightActionModal = document.getElementById('highlight-action-modal');
            const noteModal = document.getElementById('note-modal');
            const noteInput = document.getElementById('note-input');
            const highlightPreview = document.getElementById('highlighted-text-preview');

            function clearIframeSelection() {
                if (rendition) {
                    rendition.getContents().forEach(c => c.window.getSelection().removeAllRanges());
                }
            }

            function openActionModal() {
                highlightActionModal.classList.remove('hidden');
                highlightActionModal.classList.add('flex');
            }

            function closeActionModal() {
                highlightActionModal.classList.add('hidden');
                highlightActionModal.classList.remove('flex');
            }

            function openNoteModal() {
                noteModal.classList.remove('hidden');
                noteModal.classList.add('flex');
            }

            function closeNoteModal() {
                noteModal.classList.add('hidden');
                noteModal.classList.remove('flex');
            }

            function resetSelectionState() {
                currentSelection = null;
                noteInput.value = "";
                closeActionModal();
                closeNoteModal();
                clearIframeSelection();
            }

            async function saveCurrentSelection(noteText = "") {
                if (!currentSelection) return;

                const cfi = currentSelection.cfi;
                const text = currentSelection.text;

                if (rendition && !isDummyMode) {
                    rendition.annotations.highlight(cfi, {}, (e) => {
                        console.log("Highlight clicked", e);
                    });
                }

                try {
                    const response = await fetch("{{ route('notes.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            book_id: {{ $book->id }},
                            cfi_range: cfi,
                            highlighted_text: text,
                            note_content: noteText,
                            color_code: '#FDE047'
                        })
                    });

                    if (!response.ok) throw new Error("Failed to save note");
                    console.log("Highlight saved successfully!");
                } catch (error) {
                    console.error("Error saving note:", error);
                    alert("Failed to save note to database.");
                } finally {
                    resetSelectionState();
                }
            }

            // 1. Listen for text selection
            function registerHighlightHandler() {
                if (!rendition || isDummyMode) {
                    return;
                }

                rendition.on("selected", function (cfiRange, contents) {
                // Get the actual text the user highlighted
                epubBook.getRange(cfiRange).then(function (range) {
                    const selectedText = range.toString();

                    if (selectedText.trim() !== "") {
                        currentSelection = {
                            cfi: cfiRange,
                            text: selectedText
                        };

                        // Show action chooser first
                        highlightPreview.innerText = `"${selectedText}"`;
                        openActionModal();
                    }
                });
            });
            }

            // 2. Handle Cancel
            document.getElementById('cancel-action-btn').onclick = function () {
                resetSelectionState();
            };

            document.getElementById('highlight-only-btn').onclick = async function () {
                await saveCurrentSelection("");
            };

            document.getElementById('add-note-btn').onclick = function () {
                closeActionModal();
                openNoteModal();
            };

            document.getElementById('cancel-note-btn').onclick = function () {
                resetSelectionState();
            };

            // 3. Handle Save Note
            document.getElementById('save-note-btn').onclick = async function () {
                if (!currentSelection) return;

                const noteText = noteInput.value;
                await saveCurrentSelection(noteText);
            };
        });
    </script>
@endsection
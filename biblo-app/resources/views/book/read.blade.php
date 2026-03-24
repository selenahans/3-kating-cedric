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

            let book = ePub(url);
            let rendition = book.renderTo("viewer", {
                width: "100%",
                height: "100%",
                flow: "paginated",
                spread: "none",
                allowScriptedContent: true
            });

            rendition.display();

            book.ready.then(() => {
                loading.style.display = "none";
                registerHighlightHandler();
            });

            // --- Navigation (OLD SIMPLE VERSION) ---
            document.getElementById("next").onclick = (e) => {
                e.preventDefault();
                rendition.next();
            };

            document.getElementById("prev").onclick = (e) => {
                e.preventDefault();
                rendition.prev();
            };

            rendition.on("relocated", function (location) {
                const current = location.start.displayed.page;
                const total = location.start.displayed.total;

                // Update navbar dynamically
                document.getElementById("reader-current-page").textContent = current;
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

                // Highlight in reader
                rendition.annotations.highlight(cfi, {}, (e) => {
                    console.log("Highlight clicked", e);
                });

                // Reset UI
                noteModal.classList.add('hidden');
                noteModal.classList.remove('flex');
                noteInput.value = "";

                if (rendition) {
                    rendition.getContents().forEach(c =>
                        c.window.getSelection().removeAllRanges()
                    );
                }

                // Send to backend (optional, keep yours if already working)
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
                            note_content: noteInput.value,
                            color_code: "#FDE047"
                        })
                    });
                } catch (error) {
                    console.error("Failed to save note:", error);
                }

                currentSelection = null;
            };
        });
    </script>
@endsection
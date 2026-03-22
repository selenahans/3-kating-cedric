@extends('layouts.read')

@section('title', 'Reading: ' . $book->title)

@section('content')

    {{-- Navbar --}}
    <x-read.navbar :title="$book->title" :currentPage="$progress->current_location ?? 'Start'"
        :totalPages="$book->total_pages ?? '100%'" />

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

    {{-- Note Taking Modal (Hidden by default) --}}
    <div id="note-modal"
        class="fixed inset-0 z-[100] bg-biblo-charcoal/40 backdrop-blur-sm hidden flex items-center justify-center px-4">
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
            const url = "{{ asset('storage/' . $book->file_path) }}";
            const book = ePub(url);

            const rendition = book.renderTo("viewer", {
                width: "100%",
                height: "100%",
                flow: "paginated",
                spread: "none",
                allowScriptedContent: true
            });

            rendition.display();

            book.ready.then(function () {
                loading.style.display = "none";

                // TODO: Later, you will fetch existing notes from the DB here 
                // and loop through them using rendition.annotations.highlight(note.cfi)
            });

            document.getElementById("next").onclick = () => rendition.next();
            document.getElementById("prev").onclick = () => rendition.prev();

            // --- HIGHLIGHT & NOTES LOGIC ---

            let currentSelection = null;
            const noteModal = document.getElementById('note-modal');
            const noteInput = document.getElementById('note-input');
            const highlightPreview = document.getElementById('highlighted-text-preview');

            // 1. Listen for text selection
            rendition.on("selected", function (cfiRange, contents) {
                // Get the actual text the user highlighted
                book.getRange(cfiRange).then(function (range) {
                    const selectedText = range.toString();

                    if (selectedText.trim() !== "") {
                        currentSelection = {
                            cfi: cfiRange,
                            text: selectedText
                        };

                        // Show Modal
                        highlightPreview.innerText = `"${selectedText}"`;
                        noteModal.classList.remove('hidden');
                    }
                });
            });

            // 2. Handle Cancel
            document.getElementById('cancel-note-btn').onclick = function () {
                noteModal.classList.add('hidden');
                noteInput.value = "";
                currentSelection = null;
                // Clear the temporary selection in the iframe
                rendition.getContents().forEach(c => c.window.getSelection().removeAllRanges());
            };

            // 3. Handle Save Note
            document.getElementById('save-note-btn').onclick = async function () {
                if (!currentSelection) return;

                const noteText = noteInput.value;
                const cfi = currentSelection.cfi;
                const text = currentSelection.text;

                // A. Apply the highlight visually in the reader right now
                rendition.annotations.highlight(cfi, {}, (e) => {
                    console.log("Highlight clicked", e);
                });

                // B. Hide modal and reset
                noteModal.classList.add('hidden');
                noteInput.value = "";
                rendition.getContents().forEach(c => c.window.getSelection().removeAllRanges());

                // C. Send to Laravel Backend
                // C. Send to Laravel Backend
                try {
                    const response = await fetch("{{ route('notes.store') }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            // Grabs the token from the meta tag in your layout
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            book_id: {{ $book->id }},
                            cfi_range: cfi,               // Matches your DB
                            highlighted_text: text,       // Matches your DB
                            note_content: noteText,       // Matches your DB
                            color_code: '#FDE047'         // A default yellow hex code
                        })
                    });

                    if (!response.ok) throw new Error("Failed to save note");
                    console.log("Highlight and note saved successfully!");

                } catch (error) {
                    console.error("Error saving note:", error);
                    alert("Failed to save note to database.");
                }
            };
        });
    </script>
@endsection
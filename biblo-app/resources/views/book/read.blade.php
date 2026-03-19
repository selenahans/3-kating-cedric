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

            // hide loading when ready
            book.ready.then(function () {
                loading.style.display = "none";
            });


            // next / prev buttons
            document.getElementById("next").onclick = () => rendition.next();
            document.getElementById("prev").onclick = () => rendition.prev();

        });
    </script>
@endsection
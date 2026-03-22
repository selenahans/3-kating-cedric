<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HighlightNote;

class NoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'cfi_range' => 'required|string',
            'highlighted_text' => 'required|string',
        ]);

        // Create the record using your model
        HighlightNote::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'cfi_range' => $request->cfi_range,
            'highlighted_text' => $request->highlighted_text,
            'note_content' => $request->note_content, // Can be null if they just highlight without typing
            'color_code' => $request->color_code ?? '#FDE047', // Default to a nice yellow highlight
        ]);

        return response()->json(['success' => true]);
    }

    public function index()
    {
        // 1. Fetch all notes for the logged-in user, newest first
        // 'with('book')' prevents the N+1 query problem!
        $notes = HighlightNote::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        // 2. Calculate dynamic stats
        $totalHighlights = $notes->count();

        // Count how many actually have written notes (not just highlights)
        $totalNotes = $notes->filter(function ($note) {
            return !empty(trim($note->note_content));
        })->count();

        // 3. Pass to the view
        return view('mynotes', compact('notes', 'totalHighlights', 'totalNotes'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HighlightNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'cfi_range' => ['required', 'string'],
            'highlighted_text' => ['required', 'string'],
            'note_content' => ['nullable', 'string'],
            'color_code' => ['nullable', 'string', 'max:20'],
        ]);

        HighlightNote::create([
            'user_id' => $request->user()->id,
            'book_id' => $validated['book_id'],
            'cfi_range' => $validated['cfi_range'],
            'highlighted_text' => $validated['highlighted_text'],
            'note_content' => $validated['note_content'] ?? null,
            'color_code' => $validated['color_code'] ?? '#FDE047',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Highlight dan note berhasil disimpan.',
        ]);
    }

    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $sort = $request->query('sort', 'latest');

        $query = HighlightNote::with('book')
            ->where('user_id', $request->user()->id);

        if ($search !== '') {
            $query->where(function (Builder $noteQuery) use ($search) {
                $noteQuery->where('highlighted_text', 'like', '%' . $search . '%')
                    ->orWhere('note_content', 'like', '%' . $search . '%')
                    ->orWhereHas('book', function (Builder $bookQuery) use ($search) {
                        $bookQuery->where('title', 'like', '%' . $search . '%')
                            ->orWhere('author', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($sort === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $notes = $query->get();

        $totalHighlights = $notes->count();
        $totalNotes = $notes->filter(function ($note) {
            return !empty(trim((string) $note->note_content));
        })->count();

        return view('mynotes', compact('notes', 'totalHighlights', 'totalNotes', 'search', 'sort'));
    }
}
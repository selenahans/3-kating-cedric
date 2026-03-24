<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\HighlightNote;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q', ''));
        $userId = $request->user()->id;

        $books = collect();
        $categories = collect();
        $notes = collect();

        if ($search !== '') {
            $books = Book::with('category')
                ->where(function (Builder $bookQuery) use ($search) {
                    $bookQuery->where('title', 'like', '%' . $search . '%')
                        ->orWhere('author', 'like', '%' . $search . '%')
                        ->orWhereHas('category', function (Builder $categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', '%' . $search . '%');
                        });
                })
                ->latest()
                ->take(8)
                ->get();

            $categories = Category::where('name', 'like', '%' . $search . '%')
                ->withCount('books')
                ->orderBy('name')
                ->take(8)
                ->get();

            $notes = HighlightNote::with('book.category')
                ->where('user_id', $userId)
                ->where(function (Builder $noteQuery) use ($search) {
                    $noteQuery->where('highlighted_text', 'like', '%' . $search . '%')
                        ->orWhere('note_content', 'like', '%' . $search . '%')
                        ->orWhereHas('book', function (Builder $bookQuery) use ($search) {
                            $bookQuery->where('title', 'like', '%' . $search . '%')
                                ->orWhere('author', 'like', '%' . $search . '%')
                                ->orWhereHas('category', function (Builder $categoryQuery) use ($search) {
                                    $categoryQuery->where('name', 'like', '%' . $search . '%');
                                });
                        });
                })
                ->latest()
                ->take(8)
                ->get();
        }

        return view('search-results', compact('search', 'books', 'categories', 'notes'));
    }
}

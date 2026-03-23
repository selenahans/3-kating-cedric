<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LibraryController extends Controller
{
    public function index(Request $request): View
    {
        $userId = $request->user()->id;
        $search = trim((string) $request->query('q', ''));
        $status = $request->query('status');
        $sort = $request->query('sort', 'latest');

        $query = Book::with(['category', 'progressRecords' => function ($progressQuery) use ($userId) {
            $progressQuery->where('user_id', $userId);
        }])->whereHas('progressRecords', function (Builder $progressQuery) use ($userId, $status) {
            $progressQuery->where('user_id', $userId)
                ->where('is_favorite', true);

            if (!empty($status)) {
                $progressQuery->where('status', $status);
            }
        });

        if ($search !== '') {
            $query->where(function (Builder $bookQuery) use ($search) {
                $bookQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('author', 'like', '%' . $search . '%')
                    ->orWhereHas('category', function (Builder $categoryQuery) use ($search) {
                        $categoryQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        switch ($sort) {
            case 'title':
                $query->orderBy('title');
                break;
            case 'author':
                $query->orderBy('author');
                break;
            case 'oldest':
                $query->oldest();
                break;
            case 'latest':
            default:
                $query->latest();
                break;
        }

        $books = $query->get();
        $totalBooks = $books->count();

        return view('mylibrary', compact('books', 'totalBooks', 'search', 'status', 'sort'));
    }
}
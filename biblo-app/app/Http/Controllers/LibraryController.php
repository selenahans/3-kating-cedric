<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\UserBookProgress; // <-- Don't forget to add this!
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        // 1. Get the current logged-in user's ID
        $userId = auth()->id();

        // 2. Get an array of book IDs that this user has favorited
        $favoritedBookIds = UserBookProgress::where('user_id', $userId)
                                        ->where('is_favorite', true)
                                        ->pluck('book_id');

        // 3. Fetch only the books that match those favorited IDs
        $books = Book::whereIn('id', $favoritedBookIds)->get();
        
        // 4. Count for the top statistic in your view
        $totalBooks = $books->count();

        // 5. Pass them to the library view
        return view('mylibrary', compact('books', 'totalBooks'));
    }
}
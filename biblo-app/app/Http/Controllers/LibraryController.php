<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index()
    {
        // Fetch all books
        $books = Book::all();
        
        // Count for the top statistic
        $totalBooks = $books->count();

        // Pass them to the library view
        return view('mylibrary', compact('books', 'totalBooks'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        // 1. Recommended (Random for now, later you can base this on user reading history)
        $recommendedBooks = Book::inRandomOrder()->take(5)->get();

        // 2. Fetch all categories from the database for the Genre section
        $genres = Category::all();

        // 3. Popular This Week (Random for now until you have a 'views' or 'reads' counter)
        $popularBooks = Book::inRandomOrder()->take(5)->get();

        // 4. New Arrivals (Sorted by newest first)
        $newArrivals = Book::latest()->take(5)->get();

        return view('explore', compact('recommendedBooks', 'genres', 'popularBooks', 'newArrivals'));
    }
}

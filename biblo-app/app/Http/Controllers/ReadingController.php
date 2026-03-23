<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\UserBookProgress;

class ReadingController extends Controller
{
    public function show($id)
    {
        $book = Book::findOrFail($id);

        $progress = UserBookProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'book_id' => $id
            ],
            [
                'current_location' => null,
                'progress_percentage' => 0
            ]
        );

        return view('reader', compact('book', 'progress'));
    }
}
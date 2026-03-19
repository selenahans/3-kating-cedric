<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;


use App\Models\Book;
use App\Models\UserBookProgress;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/onboarding', [CategoryController::class, 'showOnboarding'])->name('onboarding');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/mylibrary', [LibraryController::class, 'index'])->name('mylibrary');
Route::get('/app', function () {
    return view('layouts.app');
});
Route::get('/explore', function () {
    return view('explore');
});
Route::get('/mypet', function () {
    return view('mypet');
});
Route::get('/mynotes', function () {
    return view('mynotes');
});
Route::get('/guest', function () {
    return view('layouts.guest');
});
Route::get('/book-detail', function () {
    return view('book.detail');
});
Route::get('/book-read/{id}', function ($id) {
    // 1. Fetch the book by its ID. (findOrFail will automatically show a 404 if the ID doesn't exist)
    $book = Book::findOrFail($id);

    // 2. Create a dummy progress object for now so the view doesn't crash
    // Later, you will fetch this from a 'Progress' or 'ReadingSession' table
    $progress = (object) [
        'current_location' => '', // Starts at the beginning
        'progress_percentage' => 0
    ];

    // 3. Pass both the book and the progress to the view
    return view('book.read', compact('book', 'progress'));
})->name('book.read');
Route::get('/shop', function () {
    return view('shop');
});
Route::get('/profil', function () {
    return view('profil');
});
Route::get('/notification', function () {
    return view('notification');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
});

require __DIR__.'/auth.php';


// Route::get('/book-test', function () {
//     // 1. Create a dummy Book object 
//     // Note: Use 'file_path' to match your Migration/Model
//     $book = new Book([
//         'id' => 1,
//         'title' => 'Pride and Prejudice',
//         'author' => 'Jane Austen',
//         'file_path' => 'Pride-and-prejudice/OEBPS/content.opf', 
//         'total_pages' => 300 // Added to prevent 'undefined' in navbar
//     ]);

//     // 2. Create a dummy Progress object
//     $progress = new UserBookProgress([
//         'current_location' => null,
//         'progress_percentage' => 0
//     ]);

//     // 3. Return the view
//     return view('book.read', compact('book', 'progress'));
// });

use Illuminate\Support\Facades\File;

Route::get('/stream-book/{filename}', function ($filename) {
    // 1. Manually construct the absolute path to the file
    $path = storage_path('app/books/' . $filename);

    // 2. DEBUG: If it's still 404, uncomment the line below, 
    // refresh the page, and tell me what the output says:
    // dd($path, File::exists($path)); 

    if (!File::exists($path)) {
        return response("File not found at: " . $path, 404);
    }

    return response()->file($path, [
        'Content-Type' => 'application/epub+zip',
        'Access-Control-Allow-Origin' => '*',
    ]);
})->name('book.stream');

// Add a dummy POST route so the JS fetch doesn't 404
Route::post('/update-progress/{id}', function($id) {
    return response()->json(['status' => 'success']);
})->name('reading.update-progress');

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\NoteController;

use App\Models\User;
use App\Models\Book;
use App\Models\UserBookProgress;

/********************
 LOGIN & REGISTRATION
 ********************/
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
Route::middleware('guest')->group(function () {
    Route::get('login', function () {
        return view('auth.login');
    })->name('login');
    Route::get('register', function () {
        return view('auth.register');
    })->name('register');
    Route::post('/Auth/register', [RegisterController::class, 'store'])
        ->name('register.process');
    Route::post('/Auth/login', [LoginController::class, 'authenticate'])
        ->name('login.process');
});

/********************
 EMAIL VERIFICATION
 ********************/
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
Route::get('/email/verify', function () {
    return view('verify-email');
})->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (Request $request, $id) {

    $user = User::findOrFail($id);

    if (!hash_equals((string) $request->hash, sha1($user->getEmailForVerification()))) {
        abort(403);
    }

    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

    return redirect()->route('login')
        ->with('status', 'Email berhasil diverifikasi. Silakan login.');

})->middleware('signed')->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Link verifikasi telah dikirim ulang.');
})->middleware('throttle:6,1')->name('verification.send');


/********************
 RESET PAssWORD
 ********************/
use App\Http\Controllers\Auth\Logout;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
Route::get('/forgotpass', function () {
    return view('forgot-password');
})->name('forgot-password');
Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->name('password.update');

/********************
LOGOUT
 ********************/
Route::post('/logout', Logout::class)->name('Logout');



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
Route::get('/guest', function () {
    return view('layouts.guest');
});
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get(
    '/book-detail/{id}',
    [BookController::class, 'show']
)->name('book.detail');
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
    Route::post('/notes/save', [NoteController::class, 'store'])->name('notes.store');
    Route::get('/mynotes', [NoteController::class, 'index'])->name('notes.index');
});

require __DIR__ . '/auth.php';


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
Route::post('/update-progress/{id}', function ($id) {
    return response()->json(['status' => 'success']);
})->name('reading.update-progress');

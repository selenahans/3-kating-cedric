<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/onboarding', function () {
    return view('onboarding');
});
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/app', function () {
    return view('layouts.app');
});
Route::get('/explore', function () {
    return view('explore');
});
Route::get('/mylibrary', function () {
    return view('mylibrary');
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
Route::get('/book-read', function () {
    return view('book.read');
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

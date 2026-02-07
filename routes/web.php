<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;

Auth::routes();

// Redirect root to home
Route::get('/', [HomeController::class, 'index']);

// Home route with role-based redirect
Route::get('/home', [HomeController::class, 'redirect'])->name('home');

// Public book routes (for all authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
});

// Admin-only book routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/books', [BookController::class, 'adminIndex'])->name('books.admin.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
});
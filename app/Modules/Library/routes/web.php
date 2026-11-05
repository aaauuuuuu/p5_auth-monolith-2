<?php

use Illuminate\Support\Facades\Route;
use Modules\Library\Controllers\BookController;
use Modules\Library\Controllers\AuthorController;

Route::middleware(['web', 'auth'])->prefix('library')->name('library.')->group(function () {
    // Rute Buku
    Route::get('books', [BookController::class, 'index'])->name('books.index');
    Route::get('books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('books', [BookController::class, 'store'])->name('books.store');
    Route::post('books/{book}/borrow', [BookController::class, 'borrow'])->name('books.borrow');

    // Rute Penulis
    Route::get('authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::delete('authors/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');
});

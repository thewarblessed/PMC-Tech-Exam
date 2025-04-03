<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('authors.index');
});

//Authors
Route::get('/authors', function () {
    return view('authors.index');
});

Route::get('/create/author', function () {
    return view('authors.create');
})->name('createAuthor');

Route::get('/edit/author/{id}', [AuthorController::class, 'edit'])->name('authors.edit');
Route::get('/view/author/{id}', [AuthorController::class, 'show'])->name('authors.view');

// Books
Route::get('/books', function () {
    return view('books.index');
});
Route::get('/create/book', [BookController::class, 'create'])->name('createBook');
Route::get('/edit/book/{id}', [BookController::class, 'edit']);
Route::get('/view/book/{id}', [BookController::class, 'show']);



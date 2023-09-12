<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// get all books
Route::get("/books", [BookController::class, "getAll"]);

// get book by id
Route::get("/book/{id}", [BookController::class, "getById"]);

// get books  by author id
Route::get("/book/author/{id}", [BookController::class, "getAllBookByAuthor"]);

<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// create book
Route::post("/book", [BookController::class, "create"]);

// add tag on book
Route::post("/book/{bookId}/tag/{tagId}", [BookController::class, "store"]);

// *** delete

// delete book
Route::delete("/book/{id}", [BookController::class, "destroy"]);

//delete book tag
Route::delete("/book/{bookId}/tag/{tagId}", [
    BookController::class,
    "deleteTag",
]);

// update book
Route::patch("/book/{id}", [BookController::class, "update"]);

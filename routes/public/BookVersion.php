<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookVersionController;

// get all books versions
Route::get("/book/version/", [BookVersionController::class, "getAll"]);

// get book versions by id
Route::get("/book/version/{id}", [BookVersionController::class, "getById"]);

// get books version by publisher id
Route::get("/book/version/publisher/{id}", [
    BookVersionController::class,
    "getAllBookVersionByPublisher",
]);

// get all comment by books version
Route::get("/book/version/{id}/comments", [
    BookVersionController::class,
    "getAllComments",
]);

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibraryController;

// get all book version in library by user
Route::get("/library/user/{id}", [LibraryController::class, "getbooks"]);

// get number of books versions in library
Route::get("/library/{userId}/book/version/number", [
    LibraryController::class,
    "getNumberBooksVersions",
]);

// get note,comment,statut by book version by user
Route::get("/library/book/version/{bookVersionId}/info/{userId}", [
    LibraryController::class,
    "getInfoByBookVersion",
]);

// instert book version in library
Route::post("/library/{userId}/book/version/{bookVersionId}", [
    LibraryController::class,
    "store",
]);

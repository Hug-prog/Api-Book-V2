<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

// get all Authors
Route::get("/authors", [AuthorController::class, "getAll"]);

// get author by id
Route::get("/author/{id}", [AuthorController::class, "getById"]);

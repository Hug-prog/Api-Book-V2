<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

// create author
Route::post("/author", [AuthorController::class, "create"]);

// update author
Route::patch("/author/{id}", [AuthorController::class, "update"]);

// delete author
Route::post("/author/{id}", [AuthorController::class, "destroy"]);

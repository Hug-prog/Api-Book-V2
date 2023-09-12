<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditionController;

// get all editions
Route::get("/editions", [EditionController::class, "getAll"]);

// get edition by id
Route::get("/edition/{id}", [EditionController::class, "getById"]);

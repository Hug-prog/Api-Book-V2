<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublisherController;

// get all publishers
Route::get("/publishers", [PublisherController::class, "getAll"]);

// get publisher by id
Route::get("/publisher/{id}", [PublisherController::class, "getById"]);

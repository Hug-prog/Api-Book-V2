<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EditionController;

// create edition
Route::post("/edition", [EditionController::class, "create"]);

// update edition
Route::patch("/edition/{id}", [EditionController::class, "update"]);

// delete edition
Route::post("/edition/{id}", [EditionController::class, "destroy"]);

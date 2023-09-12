<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublisherController;

// create publisher
Route::post("/publisher", [PublisherController::class, "create"]);

// update publisher
Route::patch("/publisher/{id}", [PublisherController::class, "update"]);

// delete publisher
Route::post("/publisher/{id}", [PublisherController::class, "destroy"]);

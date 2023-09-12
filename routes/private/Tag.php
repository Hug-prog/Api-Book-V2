<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

// create tag
Route::post("/tag", [TagController::class, "create"]);

// update tag
Route::patch("/tag/{id}", [TagController::class, "update"]);

// delete tag
Route::post("/tag/{id}", [TagController::class, "destroy"]);

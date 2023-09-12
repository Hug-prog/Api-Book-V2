<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;

// ***get
Route::get("/tags", [TagController::class, "getAll"]);

// get tag by id
Route::get("/tag/{id}", [TagController::class, "getById"]);

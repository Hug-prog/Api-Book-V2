<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookVersionController;

// create book version
Route::post("/book/version", [BookVersionController::class, "create"]);

<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatutController;

// get all statuts
Route::get("/statuts", [StatutController::class, "getAll"]);

// get statut by id
Route::get("/statut/{id}", [StatutController::class, "getById"]);

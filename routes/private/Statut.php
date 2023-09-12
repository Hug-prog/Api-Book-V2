<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatutController;

// create statut
Route::post("/statut", [StatutController::class, "create"]);

// update statut
Route::patch("/statut/{id}", [StatutController::class, "update"]);

// delete statut
Route::post("/statut/{id}", [StatutController::class, "destroy"]);

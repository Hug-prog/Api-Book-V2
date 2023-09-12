<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

// add note and comment
Route::post("/comment", [CommentController::class, "create"]);

// delete comment
Route::delete("/comment/{id}", [CommentController::class, "destroy"]);

// update statut,note,comment by book version
Route::put("/api/comment/{userid}/book/version/{bookVersionId}", [
    CommentController::class,
    "update",
]);

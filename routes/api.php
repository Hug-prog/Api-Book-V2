<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// controller
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookVersionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\TagController;

// *****************************************************
// ***************public routes********************
// *****************************************************

// ***************Auth**********************
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

//

//

//

// ***************library**********************
// get all book version in library by user
Route::get("/library/user/{id}", [LibraryController::class, "getbooks"]);

// get number of books versions in library
Route::get("/library/{userId}/book/version/number", [
    LibraryController::class,
    "getNumberBooksVersions",
]);

// get note,comment,statut by book version by user
Route::get("/library/book/version/{bookVersionId}/info/{userId}", [
    LibraryController::class,
    "getInfoByBookVersion",
]);

// instert book version in library
Route::post("/library/{userId}/book/version/{bookVersionId}", [
    LibraryController::class,
    "store",
]);

//

//

//

// ***************book version**********************
// get all books versions
Route::get("/book/version/", [BookVersionController::class, "getAll"]);

// get book versions by id
Route::get("/book/version/{id}", [BookVersionController::class, "getById"]);

// get books version by publisher id
Route::get("/book/version/publisher/{id}", [
    BookVersionController::class,
    "getAllBookVersionByPublisher",
]);

// get all comment by books version
Route::get("/book/version/{id}/comments", [
    BookVersionController::class,
    "getAllComments",
]);

//

//

//

// ***************comment**********************

// add note and comment
Route::post("/comment", [CommentController::class, "create"]);

// delete comment
Route::delete("/comment/{id}", [CommentController::class, "destroy"]);

// update statut,note,comment by book version
Route::put("/api/comment/{userid}/book/version/{bookVersionId}", [
    CommentController::class,
    "update",
]);

//

//

//

// ***************book**********************

// ***get

// get all books
Route::get("/books", [BookController::class, "getAll"]);

// get book by id
Route::get("/book/{id}", [BookController::class, "getById"]);

// get books  by author id
Route::get("/book/author/{id}", [BookController::class, "getAllBookByAuthor"]);

//

//

//

// ***************tag**********************
// ***get
Route::get("/tags", [TagController::class, "getAll"]);

// get tag by id
Route::get("/tag/{id}", [TagController::class, "getById"]);

//

//

//

// ***************Author**********************
// get all Authors
Route::get("/authors", [AuthorController::class, "getAll"]);

// get author by id
Route::get("/author/{id}", [AuthorController::class, "getById"]);

//

//

//

// ***************statut**********************
// get all statuts
Route::get("/statuts", [StatutController::class, "getAll"]);

// get statut by id
Route::get("/statut/{id}", [StatutController::class, "getById"]);

//

//

//

// ***************publisher**********************
// get all publishers
Route::get("/publishers", [PublisherController::class, "getAll"]);

// get publisher by id
Route::get("/publisher/{id}", [PublisherController::class, "getById"]);

//

//

//

// ***************edition**********************
// get all editions
Route::get("/editions", [EditionController::class, "getAll"]);

// get edition by id
Route::get("/edition/{id}", [EditionController::class, "getById"]);
//

//

//
// *****************************************************
// ***************protected routes**********************
// *****************************************************

Route::group(["middleware" => ["auth:sanctum"]], function () {
    // ***************book version**********************
    // create book version
    Route::post("/book/version", [BookVersionController::class, "create"]);

    //

    //

    //

    // ***************book**********************
    // create book
    Route::post("/book", [BookController::class, "create"]);

    // add tag on book
    Route::post("/book/{bookId}/tag/{tagId}", [BookController::class, "store"]);

    // *** delete

    // delete book
    Route::delete("/book/{id}", [BookController::class, "destroy"]);

    //delete book tag
    Route::delete("/book/{bookId}/tag/{tagId}", [
        BookController::class,
        "deleteTag",
    ]);

    // update book
    Route::patch("/book/{id}", [BookController::class, "update"]);

    //

    //

    //

    // ***************tag**********************
    // create tag
    Route::post("/tag", [TagController::class, "create"]);

    // update tag
    Route::patch("/tag/{id}", [TagController::class, "update"]);

    // delete tag
    Route::post("/tag/{id}", [TagController::class, "destroy"]);

    //

    //

    //

    // ***************Author**********************
    // create author
    Route::post("/author", [AuthorController::class, "create"]);

    // update author
    Route::patch("/author/{id}", [AuthorController::class, "update"]);

    // delete author
    Route::post("/author/{id}", [AuthorController::class, "destroy"]);

    //

    //

    //

    // ***************statut**********************
    // create statut
    Route::post("/statut", [StatutController::class, "create"]);

    // update statut
    Route::patch("/statut/{id}", [StatutController::class, "update"]);

    // delete statut
    Route::post("/statut/{id}", [StatutController::class, "destroy"]);

    //

    //

    //

    // ***************publisher**********************
    // create publisher
    Route::post("/publisher", [PublisherController::class, "create"]);

    // update publisher
    Route::patch("/publisher/{id}", [PublisherController::class, "update"]);

    // delete publisher
    Route::post("/publisher/{id}", [PublisherController::class, "destroy"]);

    //

    //

    //

    // ***************edition**********************
    // create edition
    Route::post("/edition", [EditionController::class, "create"]);

    // update edition
    Route::patch("/edition/{id}", [EditionController::class, "update"]);

    // delete edition
    Route::post("/edition/{id}", [EditionController::class, "destroy"]);
});

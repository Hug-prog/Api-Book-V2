<?php

use Illuminate\Support\Facades\Route;
// controller
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookVersionController;
use App\Http\Controllers\EditionController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\StatutController;
use App\Http\Controllers\TagController;

// *****************************************************
// ***************public routes********************
// *****************************************************

// ***************Auth**********************
@include "../routes/public/Auth.php";
//

// ***************library**********************
@include "../routes/public/library.php";
//

// ***************book version**********************
@include "../routes/public/BookVersion.php";
//

// ***************comment**********************
@include "../routes/public/Comment.php";
//

// ***************book**********************
@include "../routes/public/Book.php";
//

// ***************tag**********************
@include "../routes/public/Tag.php";
//

// ***************Author**********************
@include "../routes/public/Author.php";
//

// ***************statut**********************
@include "../routes/public/Statut.php";
//

// ***************publisher**********************
@include "../routes/public/Publisher.php";
//

// ***************edition**********************
@include "../routes/public/Edition.php";
//

// *****************************************************
// ***************protected routes**********************
// *****************************************************

Route::group(["middleware" => ["auth:sanctum"]], function () {
    // ***************Auth**********************
    @include "../routes/private/Auth.php";
    // ***************book version**********************
    @include "../routes/private/BookVersion.php";
    //

    // ***************book**********************
    @include "../routes/private/Book.php";
    //

    // ***************tag**********************
    @include "../routes/private/Tag.php";
    //

    // ***************Author**********************
    @include "../routes/private/Author.php";
    //

    // ***************statut**********************
    @include "../routes/private/Statut.php";
    //

    // ***************publisher**********************
    @include "../routes/private/Publisher.php";
    //

    // ***************edition**********************
    @include "../routes/private/Edition.php";
    //
});

<?php

namespace App\Http\Controllers;
use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\Book;
use App\Models\BookVersion;
use App\Models\Comment;
use App\Models\Edition;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookVersionController extends APIBaseController
{
    public function getAll()
    {
        return $this->sendResponse(BookVersion::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        $bookversion = BookVersion::with([
            "publisher",
            "book",
            "edition",
        ])->find($id);

        if (is_null($bookversion)) {
            return $this->sendError("BookVersion not found.");
        }

        return $this->sendResponse($bookversion, "Successfully.");
    }

    /**
     * Display a listing of the resource.
     */
    public function getAllBookVersionByPublisher(int $id)
    {
        $publisher = $this->validationObject(Publisher::class, $id);

        $checkBookVersion = BookVersion::with(["publisher", "book"])
            ->where("publisher_id", $publisher->id)
            ->get();

        return $this->sendResponse($checkBookVersion, "Successfully.");
    }

    public function getAllComments(int $id)
    {
        $this->validationObject(BookVersion::class, $id);

        $getall = Comment::with(["statut"])
            ->where("book_version_id", $id)
            ->get();

        return $this->sendResponse($getall, "Successfully.");
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "book_id" => "required",
            "edition_id" => "required",
            "publisher_id" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $book = $this->validationObject(Book::class, $request->book_id);

        $edition = $this->validationObject(
            Edition::class,
            $request->edition_id
        );

        $publisher = $this->validationObject(
            Publisher::class,
            $request->publisher_id
        );

        $bookVersion = new BookVersion();
        $bookVersion->publisher()->associate($publisher);
        $bookVersion->edition()->associate($edition);
        $bookVersion->book()->associate($book);
        $bookVersion->save();

        return $this->sendResponse(
            $bookVersion,
            "BookVersion Created Successfully."
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookVersion $bookVersion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // $bookVersion = BookVersion::find($id);

        // if (is_null($bookVersion)) {
        //     return $this->sendError("BookVersion not found.");
        // }

        // return $this->sendResponse(
        //     $bookVersion->delete(),
        //     "BookVersion deleted Successfully."
        // );
    }
}

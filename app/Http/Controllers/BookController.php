<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController as APIBaseController;
use App\Models\Author;
use App\Models\Book;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BookController extends APIBaseController
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->sendResponse(Book::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        $book = Book::with("author")->find($id);

        if (is_null($book)) {
            return $this->sendError("Book not found.");
        }

        return $this->sendResponse($book, "Successfully.");
    }

    public function getAllBookByAuthor(int $id)
    {
        $author = $this->validationObject(Author::class, $id);

        $checkBook = Book::where("author_id", $author->id)->get();

        return $this->sendResponse($checkBook, "Successfully.");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkbook = Book::where("description", $request->description)->get();

        if (empty($checkbook->items)) {
            $validator = Validator::make($request->all(), [
                "libelle" => "required",
                "description" => "required",
                "author_id" => "required",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $author = $this->validationObject(
                Author::class,
                $request->author_id
            );

            $book = new Book();
            $book->libelle = $request->libelle;
            $book->description = $request->description;
            $book->author()->associate($author);
            $book->save();

            return $this->sendResponse($book, "Book Created Successfully.");
        }
        return $this->sendError("book are already exist.");
    }

    public function store($bookId, $tagId)
    {
        /** @var Book $book */
        $book = $this->validationObject(Book::class, $bookId);

        $tag = $this->validationObject(Tag::class, $tagId);

        $book->tags()->attach($tag);
    }

    public function deleteTag($bookId, $tagId)
    {
        /** @var Book $book */
        $book = $this->validationObject(Book::class, $bookId);

        $tag = $this->validationObject(Tag::class, $tagId);

        $book->tags()->detach($tag);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $book = $this->validationObject(Book::class, $id);

        $validator = Validator::make($request->all(), [
            "libelle" => "required",
            "description" => "required",
            "author_id" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $author = $this->validationObject(Author::class, $id);

        $book->libelle = $request->libelle;
        $book->description = $request->description;
        $book->author()->associate($author);
        $book->save();

        return $this->sendResponse($book, "Book Created Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $book = $this->validationObject(Book::class, $id);

        return $this->sendResponse(
            $book->delete(),
            "Book deleted Successfully."
        );
    }
}

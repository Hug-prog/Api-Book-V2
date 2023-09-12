<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\BaseController;
use App\Models\Author;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthorController extends BaseController
{
    public function getAll()
    {
        return $this->sendResponse(Author::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        return $this->sendResponse(
            $this->validationObject(Author::class, $id),
            "Successfully."
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkAuthor = Author::where("first_name", $request->first_name)->get();

        if (empty($checkAuthor->items)) {
            $validator = Validator::make($request->all(), [
                "first_name" => "required|string",
                "last_name" => "required|string",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $author = new Author();
            $author->first_name = $request->first_name;
            $author->last_name = $request->last_name;
            $author->save();

            return $this->sendResponse($author, "Author Created Successfully.");
        }

        return $this->sendError("Author are already exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $author = $this->validationObject(Author::class, $id);

        $validator = Validator::make($request->all(), [
            "first_name" => "required|string",
            "last_name" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $author->first_name = $request->first_name;
        $author->last_name = $request->last_name;
        $author->save();
        return $this->sendResponse($author, "Author Created Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $author = $this->validationObject(Author::class, $id);

        return $this->sendResponse(
            $author->delete(),
            "Author deleted Successfully."
        );
    }
}

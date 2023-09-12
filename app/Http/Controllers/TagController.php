<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        return $this->sendResponse(Tag::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        $tag = $this->validationObject(Tag::class, $id);

        return $this->sendResponse($tag, "Successfully.");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkTag = Tag::where("name", $request->name)->get();

        if (empty($checkTag->items)) {
            $validator = Validator::make($request->all(), [
                "name" => "required|string",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $tag = new Tag();
            $tag->name = $request->name;
            $tag->save();

            return $this->sendResponse($tag, "Tag Created Successfully.");
        }

        return $this->sendError("Tag are already exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $tag = $this->validationObject(Tag::class, $id);

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $tag->name = $request->name;
        $tag->save();
        return $this->sendResponse($tag, "Tag Created Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $tag = $this->validationObject(Tag::class, $id);

        return $this->sendResponse($tag->delete(), "Tag deleted Successfully.");
    }
}

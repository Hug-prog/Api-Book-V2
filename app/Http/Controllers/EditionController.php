<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function getAll()
    {
        return $this->sendResponse(Edition::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        return $this->sendResponse(
            $this->validationObject(Edition::class, $id),
            "Successfully."
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkEdition = Edition::where("name", $request->name)->get();

        if (empty($checkEdition->items)) {
            $validator = Validator::make($request->all(), [
                "name" => "required",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $edition = new Edition();
            $edition->name = $request->name;
            $edition->save();

            return $this->sendResponse(
                $edition,
                "Edition Created Successfully."
            );
        }

        return $this->sendError("Edition are already exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $edition = $this->validationObject(Edition::class, $id);

        $validator = Validator::make($request->all(), [
            "name" => "required",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $edition->name = $request->name;
        $edition->save();
        return $this->sendResponse($edition, "Edition Created Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $edition = $this->validationObject(Edition::class, $id);

        return $this->sendResponse(
            $edition->delete(),
            "Edition deleted Successfully."
        );
    }
}

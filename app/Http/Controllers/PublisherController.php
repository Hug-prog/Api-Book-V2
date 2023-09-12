<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as APIBaseController;

class PublisherController extends APIBaseController
{
    public function getAll()
    {
        return $this->sendResponse(Publisher::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        return $this->sendResponse(
            $this->validationObject(Publisher::class, $id),
            "Successfully."
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkPublisher = Publisher::where("name", $request->name)->get();

        if (empty($checkPublisher->items)) {
            $validator = Validator::make($request->all(), [
                "name" => "required|string",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $publisher = new Publisher();
            $publisher->name = $request->name;
            $publisher->save();

            return $this->sendResponse(
                $publisher,
                "Publisher Created Successfully."
            );
        }

        return $this->sendError("Publisher are already exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $publisher = $this->validationObject(Publisher::class, $id);

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $publisher->name = $request->name;
        $publisher->save();
        return $this->sendResponse(
            $publisher,
            "Publisher Created Successfully."
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $publisher = $this->validationObject(Publisher::class, $id);

        return $this->sendResponse(
            $publisher->delete(),
            "Publisher deleted Successfully."
        );
    }
}

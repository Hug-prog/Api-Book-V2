<?php

namespace App\Http\Controllers;

use App\Models\Statut;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StatutController extends Controller
{
    public function getAll()
    {
        return $this->sendResponse(Statut::all(), "Successfully.");
    }

    public function getById(int $id)
    {
        return $this->sendResponse(
            $this->validationObject(Statut::class, $id),
            "Successfully."
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $checkStatut = Statut::where("name", $request->name)->get();

        if (empty($checkStatut->items)) {
            $validator = Validator::make($request->all(), [
                "name" => "required|string",
            ]);

            if ($validator->fails()) {
                return $this->sendError("Validation Error, form incomplete .");
            }

            $statut = new Statut();
            $statut->name = $request->name;
            $statut->save();

            return $this->sendResponse($statut, "Statut Created Successfully.");
        }

        return $this->sendError("Statut are already exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $statut = $this->sendResponse(
            $this->validationObject(Statut::class, $id),
            "Successfully."
        );

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incomplete .");
        }

        $statut->name = $request->name;
        $statut->save();
        return $this->sendResponse($statut, "Statut Created Successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $statut = $this->sendResponse(
            $this->validationObject(Statut::class, $id),
            "Successfully."
        );

        return $this->sendResponse(
            $statut->delete(),
            "Statut deleted Successfully."
        );
    }
}

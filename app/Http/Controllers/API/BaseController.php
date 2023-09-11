<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

//model
use App\Models\BookVersion;
use App\Models\Statut;
use App\Models\User;
use App\Models\Book;
use App\Models\Comment;
use App\Models\Edition;
use App\Models\Publisher;
use App\Models\Tag;
use App\Models\Author;

class BaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            "success" => true,
            "data" => $result,
            "message" => $message,
        ];
        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            "success" => false,
            "message" => $error,
        ];

        if (!empty($errorMessages)) {
            $response["data"] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function validationObject($class, $modelId)
    {
        $object = $class::find($modelId);

        if (is_null($object)) {
            return $this->sendError("$class not found.");
        }
        return $object;
    }
}

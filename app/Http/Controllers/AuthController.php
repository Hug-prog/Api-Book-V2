<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController as APIBaseController;
use Illuminate\Support\Facades\Auth;

class AuthController extends APIBaseController
{
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|integer",
            "device_name" => "required|string",
        ]);

        if (User::where("email", $request->email)->first()) {
            return $this->sendError("User has already been registered");
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return $this->sendResponse($user, "user has created Successfully.");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "email" => "required|email",
            "password" => "required|integer",
            "device_name" => "required|string",
        ]);

        if ($validator->fails()) {
            return $this->sendError("Validation Error, form incorrecte!");
        }

        if (!Auth::attempt($request->only(["email", "password"]))) {
            return $this->sendError(
                "Email & Password does not match with our record."
            );
        }

        $user = User::where("email", $request->email)->first();

        if (!$user) {
            return $this->sendError("User does not exist");
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return $this->sendResponse($token, "User Logged In Successfully.");
    }

    public function logout()
    {
        return $this->sendResponse(Auth::user()->tokens()->delete(),"logout success");
    }
}

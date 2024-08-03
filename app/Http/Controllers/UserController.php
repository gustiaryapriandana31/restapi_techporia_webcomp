<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json([
            "message" => "All users data retrieved successfully",
            "data" => $users
        ], Response::HTTP_OK);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "username" => "required|string",
            "email" => "required|email|email:rfc, dns|unique:users,email",
            "password" => "required|string"
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => "Error Validation Error",
                "errors" => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        $validatedData = $validator->validate();
        $validatedData["password"] = bcrypt($validatedData["password"]);

        try {
            $createdUser = User::create($validatedData);
        } catch(Exception $e) {
            return response()->json([
                "message" => "Failed to create user",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            "message" => "User data created successfully",
            "data" => $createdUser
        ], Response::HTTP_CREATED);
    }

    public function show($userId) {
        $user = User::findOrFail($userId);
        return response()->json([
            "message" => "User data retrieved successfully",
            "data" => $user
        ], RESPONSE::HTTP_OK);
    }

    public function update(Request $request, $userId) {
        $validator = Validator::make($request->all(), [
            "name" => "string",
            "username" => "string",
            "email" => "email|email:rfc, dns|unique:users,email",
            "password" => "string"
        ]);

        if($validator->fails()) {
            return response()->json([
                "message" => "Error Validation Error",
                "errors" => $validator->errors()
            ], Response::HTTP_NOT_ACCEPTABLE);
        }

        $validatedData = $validator->validate();
        if(isset($validatedData["password"])) {
            $validatedData["password"] = bcrypt($validatedData["password"]);
        }

        try {
            $userData = User::findOrFail($userId);
            $userData->update($validatedData);
        } catch(Exception $e) {
            return response()->json([
                "message" => "Failed to create user",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json([
            "message" => "User data updated successfully",
            "data" => $userData
        ], Response::HTTP_CREATED);
    }

    public function destroy($userId) {
        $user = User::findOrFail($userId);

        try {
            $user->delete();
        } catch(Exception $e) {
            return response()->json([
                "message" => "Failed to delete user",
                "error" => $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } 

        return response()->json([
            "message" => "User data with id {$userId} deleted successfully",
        ], Response::HTTP_OK);
    }
}
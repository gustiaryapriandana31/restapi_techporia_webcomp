<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index() {
        $users = User::all();

        return response()->json([
            "message" => "Successfully get all users data",
            "data" => $users
        ], Response::HTTP_OK);
    }
}
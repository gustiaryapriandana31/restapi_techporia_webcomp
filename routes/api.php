<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'index']);



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
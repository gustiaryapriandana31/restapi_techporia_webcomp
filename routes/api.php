<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::post('/users/{userId}', [UserController::class, 'show']);
Route::put('/users/{userId}', [UserController::class, 'update']);
Route::delete('/users/{userId}', [UserController::class, 'destroy']);



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
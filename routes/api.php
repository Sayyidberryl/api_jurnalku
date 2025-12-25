<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'registerUser']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logoutUser']);

Route::get('/user/get', [ExploreController::class, 'getUser']);
Route::get('/search/user', [ExploreController::class, 'searchUser']);

// Profile Management Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [ProfileController::class, 'getProfile']);
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto']);
    Route::post('/profile/password', [ProfileController::class, 'changePassword']);
});

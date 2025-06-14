<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login/username', 'loginByUsername');
});
Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('/info', 'getUserById');
})->middleware('jwt.auth');
Route::prefix('profile')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'getProfile');
    Route::put('/', 'updateProfile');
})->middleware('jwt.auth');

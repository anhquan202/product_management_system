<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login/username', 'loginByUsername');
    Route::get('/refresh-token', 'refreshToken');
});

Route::prefix('profile')
    ->middleware(['jwt.auth.custom'])
    ->controller(ProfileController::class)
    ->group(function () {
        Route::post('/me', 'getProfile');
        // Route::put('/', 'updateProfile');
    });
Route::prefix('admin')
    ->middleware(['jwt.auth.custom', 'check.role:admin', 'check.permission:user.read'])
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'getUsers');
        Route::get('/users/{user_id}', 'getUserById');
    });
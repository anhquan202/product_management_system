<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login/username', 'loginByUsername');
});

Route::prefix('profile')
    ->middleware(['jwt.auth.custom'])
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('/', 'getProfile');
        Route::put('/', 'updateProfile');
    });
Route::prefix('admin')
    ->middleware(['jwt.auth.custom', 'check.role:admin'])
    ->controller(UserController::class)
    ->group(function () {
        Route::get('/users', 'getUsers');
        Route::put('/users/{id}', 'updateUser');
        Route::delete('/users/{id}', 'deleteUser');
    });
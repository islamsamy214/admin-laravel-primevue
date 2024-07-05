<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user', [AuthController::class, 'user'])
        ->name('user');

    Route::post('refresh', [AuthController::class, 'refresh'])
        ->name('refresh');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');
}); //end of middleware

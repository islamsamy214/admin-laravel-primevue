<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('register', [AuthController::class, 'register'])
    ->name('register');

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::post('refresh', [AuthController::class, 'refresh'])
    ->name('refresh')
    ->middleware(['api', 'auth:sanctum']);

Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware(['api', 'auth:sanctum']);

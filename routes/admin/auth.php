<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::post('refresh', [AuthController::class, 'refresh'])
    ->name('refresh');

Route::post('logout', [AuthController::class, 'logout'])
    ->name('logout');
    
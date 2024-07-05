<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::post('login', [AuthController::class, 'login'])
    ->name('login');

Route::group(['middleware' => ['admin:sanctum']], function () {
    Route::get('user', [AuthController::class, 'user'])
        ->name('user');

    Route::post('refresh', [AuthController::class, 'refresh'])
        ->name('refresh');

    Route::post('logout', [AuthController::class, 'logout'])
        ->name('logout');

}); //end of middleware

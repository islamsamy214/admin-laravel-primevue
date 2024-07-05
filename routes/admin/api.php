<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SeoController;

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    require __DIR__ . '/auth.php';

    Route::group(['middleware' => ['admin:sanctum']], function () {
        //dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        //users
        Route::resource('users', UserController::class)->except(['show', 'create']);
        Route::delete('users/delete/all', [UserController::class, 'destroyAll']);
        //seos
        Route::resource('seos', SeoController::class)->only(['index', 'update']);
    });
});

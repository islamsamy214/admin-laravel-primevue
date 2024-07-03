<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';

Route::group(['as' => 'api.'], function () {
    // write your public APIs here
});

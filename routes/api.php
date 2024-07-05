<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';
require __DIR__ . '/admin/api.php';

Route::group(['as' => 'api.'], function () {
    // write your public APIs here
});

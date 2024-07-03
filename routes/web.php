<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

///////////////////SPA routes//////////////////////////
Route::get(
    '/{any?}',
    function () {
        return view('index');
    }
)->where('any', '^(?!api\/)[\/\w\.\,-]*');


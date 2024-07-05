<?php

use Illuminate\Support\Facades\Route;

///////////////////SPA routes//////////////////////////
Route::get(
    '/{any?}',
    function () {
        return view('index');
    }
)->where('any', '^(?!api\/)[\/\w\.\,-]*');


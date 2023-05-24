<?php

use Illuminate\Support\Facades\Route;
use App\Models\Round;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

///////////////////SPA routes//////////////////////////
Route::get(
    '/{any?}',
    function () {
        return view('index');
    }
)->where('any', '^(?!api\/)[\/\w\.\,-]*');


// Route::get('/t',function(){
//     Round::where('name', 'ROUND1')->first()->update(['id' => '1']);
//     Round::where('name', 'ROUND2')->first()->update(['id' => '2']);
// });




// require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CvController;

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

//Route::get('/', function () {
//    return view('index', ['title' => 'Създаване на CV']);
//});

Route::get('/', [CvController::class, 'addOne'])
    ->name('cv.add_one');

Route::post('/cv/create_one', [CvController::class, 'createOne'])
    ->name('cv.create_one');

Route::get('/cv/search_by_dobs', [CvController::class, 'searchByDobs'])
    ->name('cv.search_by_dobs');
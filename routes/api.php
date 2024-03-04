<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\SkillController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/user/get_add_one', [UserController::class, 'getAddOne'])
    ->name('user.get_add_one');

Route::get('/university/search/{name}', [UniversityController::class, 'searchByName'])
    ->name('university.search_by_name');

Route::post('/university/add_one', [UniversityController::class, 'addOne'])
    ->name('university.add_one');

Route::post('/skill/add_one', [SkillController::class, 'addOne'])
    ->name('skill.add_one');
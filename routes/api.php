<?php

use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('book', [BookController::class, 'getAll']);
Route::get('book/{id}', [BookController::class, 'getById']);
Route::post('book', [BookController::class, 'create']);
Route::put('book/{id}', [BookController::class, 'updateById']);
Route::delete('book/{id}', [BookController::class, 'deleteById']);

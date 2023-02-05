<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AmvsController;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('/logout', [UsersController::class, 'logout']);
    Route::post('/delete-amv', [AmvsController::class, 'delete']);
    Route::post('/save-amv',  [AmvsController::class, 'post']);
    Route::get('/get-single-amv/{id}', [AmvsController::class, 'getSingleAmv']);
});

Route::post('/register', [UsersController::class, 'register']);
Route::post('/login', [UsersController::class, 'login']);
Route::get('/get-amv', [AmvsController::class, 'get']);

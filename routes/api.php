<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SummaryController;
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

//public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//sanctum protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/statistics', [StatisticController::class, 'getStatistics']);
    Route::get('/summary', [SummaryController::class, 'getSummary']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/check', [AuthController::class, 'checkAuth']);
});

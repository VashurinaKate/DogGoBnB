<?php

use App\Http\Middleware\CheckOrderBelongsUser;

use App\Http\Middleware\TransformUserIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AnimalController, OrderController, UserController, LocationController
};

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
Route::group([
    'prefix' => 'v1',
], function () {
    Route::apiResource('recipients', UserController::class)
        ->middleware(TransformUserIndexRequest::class);
    Route::apiResource('locations', LocationController::class);
});

Route::group([
    'prefix' => 'v1',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('animals', [AnimalController::class, 'index']);
    Route::apiResource('orders', OrderController::class)
        ->only(['index', 'store']);
    Route::apiResource('orders', OrderController::class)
        ->except(['index', 'store'])
        ->middleware(CheckOrderBelongsUser::class);
     
});

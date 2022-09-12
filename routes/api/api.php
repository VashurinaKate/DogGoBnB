<?php

use App\Http\Middleware\CheckOrderBelongsUser;
use App\Http\Middleware\TransformUserIndexRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Api\{
    AnimalController, 
    OrderController, 
    UserController, 
    LocationController, 
    ReveiwController,
    ImagesController
};
use App\Http\Resources\UserResource;
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
    return new UserResource($request->user());
});

Route::group([
    'prefix' => 'v1',
], function () {
    Route::apiResource('recipients', UserController::class)
        ->middleware(TransformUserIndexRequest::class);
    Route::apiResource('locations', LocationController::class)
        ->middleware(TransformUserIndexRequest::class);;
    Route::apiResource('reviews', ReveiwController::class);
    Route::apiResource('users', UserController::class);
    // Route::post('image/save', [ImageController::class, 'index']);
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
    // Route::apiResource('users', UserController::class);
    Route::apiResource('reviewsave', ReveiwController::class);
    Route::apiResource('usersave', UserController::class);
    Route::apiResource('image/save', ImagesController::class);
 });
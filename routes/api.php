<?php

use App\Http\Controllers\API\CardController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\FrameController;
use App\Http\Controllers\API\FrameImagesController;
use App\Http\Controllers\API\FrameColorController;
use App\Http\Controllers\API\LensTypeController;
use App\Http\Controllers\API\TransactionController;
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

Route::apiResource('customers', CustomerController::class);
Route::apiResource('cards', CardController::class);
Route::apiResource('frames', FrameController::class);
Route::apiResource('frameimages', FrameImagesController::class);
Route::apiResource('framecolor', FrameColorController::class);
Route::apiResource('lenstype', LensTypeController::class);
Route::apiResource('cart', CartController::class);
Route::apiResource('transact', TransactionController::class);

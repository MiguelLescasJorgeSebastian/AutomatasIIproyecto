<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

    Route::get('/producto', [ProductController::class, 'index']);
    Route::post('/producto', [ProductController::class, 'store']); // Add this line to handle POST requests
    Route::get('/producto/{id}', [ProductController::class, 'show']);
    Route::put('/producto/{id}', [ProductController::class, 'update']);
    Route::delete('/producto/{id}', [ProductController::class, 'destroy']);
    
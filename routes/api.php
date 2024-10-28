<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
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

/**
 * Your API routes definitions here
 */

Route::get('/stuck-in-the-middle', function () {
    return response()->json(['message' => 'Success! You are no longer stuck in the middle.']);
})->middleware('stuck.in.the.middle');

Route::get('/movies', [MovieController::class, 'index']);

Route::get('/movies/{movie}', [MovieController::class, 'show']);

Route::patch('/movies/{movie}', [MovieController::class, 'update']);

Route::post('/movies', [MovieController::class, 'store']);

Route::delete('/movies/{movie}', [MovieController::class, 'destroy']);

Route::prefix('/movies/{movie}/reviews')->group(function () {
    Route::get('/', [ReviewController::class, 'index']);
    Route::post('/', [ReviewController::class, 'store']);
});

Route::patch('/reviews/{review}', [ReviewController::class, 'update']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
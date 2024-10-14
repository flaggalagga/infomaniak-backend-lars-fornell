<?php

use App\Http\Middleware\StuckInTheMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ping', fn() => 'pong');

Route::get('/stuck-in-the-middle', function (Request $request) {
    if ($request->header('X-Stuck-In-The-Middle','yes') !== 'no') {
        return Response::make(null, 403);
    }
    return Response::make();
})->middleware(StuckInTheMiddleware::class);

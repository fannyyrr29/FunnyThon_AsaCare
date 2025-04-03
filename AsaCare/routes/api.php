<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ActionController;
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

Route::get('/actions', [ActionController::class, 'index']);

// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/update', [UserController::class, 'store']);
// Route::get('/show/{id}', [UserController::class, 'show']);

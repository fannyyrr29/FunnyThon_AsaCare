<?php

use App\Http\Controllers\User\InviteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('/findFriend', [InviteController::class, 'searchFriend']);
// Route::post('/editProfil', [HomeController::class, 'editProfile']);
// Route::get('/showProfile/{id}', [HomeController::class, 'showProfile']);
// Route::get('/call/{id}', [HomeController::class, 'showEmergencyCall']);
// Route::get('/medicalRecord/{id}', [HomeController::class, 'showMedicalRecord'])->name('user.medicalrecord');
// Route::get('/obat', [HomeController::class, 'showDrug']);
// Route::get('/layanan', [HomeController::class, 'showAction']);
// Route::get('/family/{id}', [InviteController::class, 'index']);
// ROute::post('/addFriend', [InviteController::class, 'addFriend']);
// Route::post('/addMood', [HomeController::class, 'addMood']);
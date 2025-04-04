<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ActionController;
use App\Http\Controllers\User\CallController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\MedicalRecordController;
use App\Models\EmergencyCall;
use App\Models\MedicalRecord;

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

// Route::post('/editProfil', [HomeController::class, 'editProfile']);
// Route::get('/showProfile/{id}', [HomeController::class, 'showProfile']);
// Route::get('/call/{id}', [HomeController::class, 'showEmergencyCall']);
// Route::get('/medicalRecord/{id}', [HomeController::class, 'showMedicalRecord'])->name('user.medicalrecord');
// Route::get('/obat', [HomeController::class, 'showDrug']);
Route::get('/layanan', [HomeController::class, 'showAction']);

<?php

use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\MedicalRecordController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\ActionController;
use App\Http\Controllers\User\InviteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\ReminderController;
use App\Models\Doctor;

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

// Route::get('/hospital', [HospitalController::class, 'index']);
// Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
// Route::get('/doctor/', [DoctorController::class, 'index']);
// Route::put('/user/{id}', [UserController::class, 'update']);
// Route::delete('/user/{id}', [UserController::class, 'destroy']);
// Route::delete('/medicalRecord/{id}', [MedicalRecordController::class, 'destroy']);
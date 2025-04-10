<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Doctor\DasboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\MedicalRecordController;
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
Route::post('/login', [LoginController::class, 'authenticate']);


// Route::get('/hospital', [HospitalController::class, 'index']);
// Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
// Route::get('/doctor/', [DoctorController::class, 'index']);
// Route::put('/user/{id}', [UserController::class, 'update']);
// Route::delete('/user/{id}', [UserController::class, 'destroy']);
// Route::delete('/medicalRecord/{id}', [MedicalRecordController::class, 'destroy']);
// Route::delete('/obat/{id}', [DrugController::class, 'destroy']);
// Route::get('/medicalRecord', [DoctorMedicalRecordController::class, 'index']);
Route::resource('/dashboard', DoctorDashboardController::class);
Route::get('/edit/{id}', [MedicalRecordController::class, 'edit']);
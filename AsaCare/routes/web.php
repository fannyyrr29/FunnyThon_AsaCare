<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//hanya bisa diakses oleh user yang belum terautentikasi
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

// Route untuk User
Route::group(['prefix' => 'user'], function() {
    //Untuk menampilkan home
    Route::get('/home', [UserController::class, 'home']);

    

    // Untuk Edit Profil
    Route::resource('/editProfil', UserController::class)->only(['index', 'store', 'show']);
});

Route::get('/home', function(){
    return view('users/home');
});

Route::get('/homecare', function(){
    return view('users/homecare');
});

Route::get('/reminderObat', function(){
    return view('users/reminderObat');
});

Route::get('/telp', function(){
    return view('users/telp');
});

Route::get('/tokoObat', function(){
    return view('users/tokoObat');
});

Route::get('/ringkasanBayar', function(){
    return view('users/ringkasanBayar');
});

Route::get('/riwayat', function(){
    return view('users/riwayat');
});

Route::get('/menuObat', function(){
    return view('users/menuObat');
});

Route::get('/setReminder', function(){
    return view('users/setReminder');
});

Route::get('/editProfile', function(){
    return view('users/editProfile');
});

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

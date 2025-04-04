<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\PusherController;
use Illuminate\Support\Facades\Route;
use Pusher\Pusher;

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
Route::get('/login', function(){
    return view('users/login');
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

Route::get('/konsultasi', [PusherController::class, 'index']);

Route::post('/konsultasi/broadcast', [PusherController::class, 'broadcast']);

Route::post('/konsultasi/receive', [PusherController::class, 'receive']);

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

// Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InviteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherController;
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
    return view('users/tokoobat');
});


//hanya bisa diakses oleh user yang belum terautentikasi
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);


// Route untuk User 
Route::middleware(['auth', 'role:User'])->prefix('user')->group(function(){
    //Untuk menampilkan home
    Route::get('/home', [HomeController::class, 'index']);
    //Untuk show profile di halaman edit
    Route::get('/showProfile/{id}', [HomeController::class, 'showProfile'])->name('user.profile');
    //Untuk menyimpan perubahan di db
    Route::post('/editProfil', [HomeController::class, 'editProfile'])->name('user.editProfile');
    //Menampilkan List Kontak
    Route::get('/call/{id}', [HomeController::class, 'showEmergencyCall'])->name('user.call');
    //Menampilkan riwayat kesehatan user
    Route::get('/medicalRecord/{id}', [HomeController::class, 'showMedicalRecord'])->name('user.medicalrecord');
    //Untuk menampilkan obat-obatan
    Route::get('/obat', [HomeController::class, 'showDrug'])->name('user.drug');
    //Untuk menampilkan layanan
    Route::get('/layanan', [HomeController::class, 'showAction'])->name('user.layanan');
    //untuk input kondisi
    Route::post('/addMood', [HomeController::class, 'addMood'])->name('user.mood');
    //untuk cari teman
    Route::post('/findFriend', [InviteController::class, 'searchFriend'])->name('user.search');
    //untuk add teman 
    Route::post('/addFriend', [InviteController::class, 'addFriend'])->name('user.add');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function(){

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

Route::get('/reservasi', function(){
    return view('users/reservasi');
});


Route::get('/riwayat', function(){
    return view('users/riwayat');
});
Route::get('/riwayatBeliObat', function(){
    return view('users/riwayatBeliObat');
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

Route::get('/konsultasi/{chat_id}', [PusherController::class, 'index']);

Route::post('/konsultasi/broadcast', [PusherController::class, 'broadcast']);

Route::post('/konsultasi/receive', [PusherController::class, 'receive']);

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

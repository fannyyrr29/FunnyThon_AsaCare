<?php

use App\Http\Controllers\Admin\ActionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\HospitalController;
use App\Http\Controllers\Admin\MedicalRecordController;
use App\Http\Controllers\Admin\SpecializationController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Doctor\DasboardController;
use App\Http\Controllers\Doctor\MedicalRecordController as DoctorMedicalRecordController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\InviteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\User\DrugController;
use App\Http\Controllers\User\ReminderController;
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

// Route::get('/', function () {
//     return view('doctors/diagnosa');
// });

Route::get('/', [LoginController::class, 'index'])->middleware('guest');

//hanya bisa diakses oleh user yang belum terautentikasi
Route::get('/login', [LoginController::class, 'index'])->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


// Route untuk User 
Route::middleware(['auth', 'role:User'])->prefix('user')->group(function(){
    //Untuk menampilkan home
    Route::get('/', [HomeController::class, 'index'])->name('user.home');
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
    //untuk accept pertemanan 
    Route::post('/addFriend', [InviteController::class, 'addFriend'])->name('user.add');
    //dipanggil ketika user menekan button checkout
    Route::post('/keranjang', [DrugController::class, 'checkout'])->name('user.checkout');
    //untuk menolak pertemanan
    Route::post('/tolak', [InviteController::class, 'reject'])->name('user.reject');
    //untuk menampilkan Kondisi dari User
    Route::post('/kondisi/{id}', [HomeController::class, 'showMood'])->name('user.showMood');
    //untuk search HomeCare
    Route::get('/homecare', [HomeController::class, 'showActionHomeCare'])->name('user.showHomeCare');
    //untuk search HospitalCare
    Route::get('/hospitalcare', [HomeController::class, 'showHospitalCare'])->name('user.showHospitalCare');
    //untuk search layanan berdasarkan nama
    Route::post('/cariLayanan', [HomeController::class, 'cariLayanan'])->name('user.searchAction');
    //untuk menampilkan reminder user
    Route::get('/reminder/{id}', [ReminderController::class, 'index'])->name('user.reminder');
    //untuk update status reminder
    Route::post('/update', [ReminderController::class, 'updateStatus'])->name('user.updateReminder');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function(){
    //untuk show dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('hospital', HospitalController::class)->names('admin.rumahsakit');
    Route::resource('doctor', DoctorController::class)->names('admin.dokter');
    Route::resource('action', ActionController::class)->names('admin.layanan'); 
    Route::resource('user', UserController::class)->names('admin.user');
    Route::resource('specialization', SpecializationController::class)->names('admin.spesialisasi');
    Route::resource('medicalRecord', MedicalRecordController::class)->names('admin.riwayatKesehatan');
});

Route::middleware(['auth', 'role:Dokter'])->prefix('doctor')->group(function(){
    Route::get('/', [DasboardController::class, 'index'])->name('doctor.index');
    Route::resource('medicalRecord', DoctorMedicalRecordController::class);
});


Route::get('/homecare', function(){
    return view('users/home');
});

Route::get('/family', function(){
    return view('users/family');
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

Route::get('/listChat', function(){
    return view('doctors/listChat');
});

Route::get('/konsultasi/{chat_id}', [PusherController::class, 'index']);

Route::post('/konsultasi/broadcast', [PusherController::class, 'broadcast']);

Route::post('/konsultasi/receive', [PusherController::class, 'receive']);

Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);

Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);

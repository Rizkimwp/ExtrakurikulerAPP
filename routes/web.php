<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExtrakurikulerController;


Route::get('/login', [AuthController::class, 'index'])->name('loginview');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[DashboardController::class, 'index']) ->name('dashboard');

    // Extrakurikuler
    Route::get('/extrakurikuler', [ExtrakurikulerController::class, 'index'])->name('extrakurikuler');
    Route::post('/extrakurikuler', [ExtrakurikulerController::class, 'store'])->name('extracreate');

    // Event
    Route::get('/event', [EventController::class, 'index'])->name('event');

    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('createsiswa');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('updatesiswa');
    Route::delete('/siswa/{id}', [SiswaController::class, 'delete'])->name('deletesiswa');

    // Member
    Route::get('/member', [MemberController::class, 'index'])->name('member');
});
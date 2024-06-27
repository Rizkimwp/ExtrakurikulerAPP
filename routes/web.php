<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GaleryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ExtrakurikulerController;


// Landing Page

Route::get('/', [LandingPageController::class, 'index']);


Route::get('/login', [AuthController::class, 'index'])->name('loginview');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->group(function () {
    // Generate PDF
    Route::get('/reports/pdf', [DashboardController::class, 'generateReportPDF'])->name('reports.pdf');

    Route::get('/profile', [UserController::class, 'show'])->name('showprofile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/data', [DashboardController::class, 'data'])->name('data');
    Route::get('/count', [DashboardController::class, 'getSiswa'])->name('count');
    // Extrakurikuler
    Route::get('/extrakurikuler', [ExtrakurikulerController::class, 'index'])->name('extrakurikuler');
    Route::post('/extrakurikuler', [ExtrakurikulerController::class, 'store'])->name('extracreate');
    Route::delete('/extrakurikuler/{id}', [ExtrakurikulerController::class, 'delete'])->name('extradelete');

    // Member
    Route::get('/member', [MemberController::class, 'index'])->name('member');
    Route::post('/member', [MemberController::class, 'store'])->name('membercreate');
    Route::put('/member/{id}', [MemberController::class, 'update'])->name('memberupdate');
    Route::delete('/member/{id}', [MemberController::class, 'delete'])->name('memberdelete');

    // Password
    Route::get('/password/change', [UserController::class, 'showChangePassword'])->name('password.change');
    Route::post('/password/update', [UserController::class, 'changePassword'])->name('password.update');

    // Kelas
    Route::get('/kelas', [KelasController::class, 'index'])->name('kelas');
    Route::post('/kelas', [KelasController::class, 'store'])->name('createkelas');
    Route::delete('/kelas/{id}', [KelasController::class, 'destroy'])->name('deletekelas');
    // Blog
    Route::get('/posts', [PostsController::class, 'index'])->name('posts');
    Route::post('/posts', [PostsController::class, 'store'])->name('postscreate');
    Route::put('/posts/{id}', [PostsController::class, 'update'])->name('postsupdate');
    Route::delete('/posts/{id}', [PostsController::class, 'destroy'])->name('postsdelete');
});

Route::middleware(['auth:sanctum', 'role:superadmin'])->group(function () {
    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('createsiswa');
    Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('updatesiswa');
    Route::delete('/siswa/{id}', [SiswaController::class, 'delete'])->name('deletesiswa');



    // Kelas


    // Galery
    Route::get('/galery', [GaleryController::class, 'index'])->name('galery');
    Route::post('/galery', [GaleryController::class, 'store'])->name('creategalery');
    Route::put('/galery/{id}', [GaleryController::class, 'update'])->name('updategalery');
    Route::delete('/galery/{id}', [GaleryController::class, 'destroy'])->name('deletegalery');

    Route::post('/album', [AlbumController::class, 'store'])->name('createalbum');
    Route::put('/album/{id}', [AlbumController::class, 'update'])->name('updatealbum');
    Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('deletealbum');

    // Manajemen Akun
    Route::get('/akun', [UserController::class, 'index'])->name('user');
    Route::post('/akun', [UserController::class, 'store'])->name('user.create');
    Route::put('/akun/{id}', [UserController::class, 'update'])->name('user.edit');
    Route::delete('/akun/{id}', [UserController::class, 'destroy'])->name('user.delete');

});
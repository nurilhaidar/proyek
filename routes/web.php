<?php

use App\Http\Controllers\AdminContoller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FormPeminjamanController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use App\Models\PeminjamanModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\Author;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

Route::get('/', [UserController::class, 'index']);
Route::resource('peminjaman', UserController::class);
Route::get('inventaris', [UserController::class, 'inventaris']);
Route::get('peminjaman', [UserController::class, 'peminjaman']);

Route::middleware(['auth'])->group(function () {
    Route::prefix('administrator')->group(function () {
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
        Route::resource('inventaris', BarangController::class);
        Route::resource('peminjaman', PeminjamanController::class);
        Route::get('peminjaman%blm%konfirm', [PeminjamanController::class, 'blmKonfirm']);
        Route::get('peminjaman%blm%kembali', [PeminjamanController::class, 'blmKembali']);
        Route::put('status/{id}', [PeminjamanController::class, 'status']);
        Route::get('profile/{id}', [AdminContoller::class, 'edit']);
        Route::put('profile/{id}', [AdminContoller::class, 'update']);

        Route::middleware('admin')->group(function () {
            Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
            Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
            Route::resource('user', AdminContoller::class);
        });
    });
});

<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\NormalNewsController;
use App\Http\Controllers\admin\RootNewsController;
use App\Http\Controllers\admin\RootUserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['middleware' => 'guest'], function () {
    Route::get('/auth/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/auth/login', [AuthController::class, 'loginPost'])->name('admin.login');
});

// Route::middleware(['auth', 'check-role:root'])->group(function () {
//     Route::get('/admin', function () {
//         return view('welcome');
//     });
// });

// Route::middleware(['auth', 'check-role:normal'])->group(function () {
// Rute-rute yang hanya dapat diakses oleh pengguna dengan peran "normal user"
//     Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
//     Route::delete('/logout', [AuthController::class, 'logout'])->name('admin.logout');
//     Route::resource('/news', NewsController::class);
// });

Route::group(['middleware' => 'check-role:root', 'as' => 'root.'], function () {
    Route::get('/root', [AdminController::class,'indexRoot'])->name('admin.index');
    Route::delete('/logoutRoot', [AuthController::class, 'logout'])->name('admin.logout');
    Route::resource('/newsRoot', RootNewsController::class);
    Route::resource('/userRoot', RootUserController::class);
});
Route::group(['middleware' => 'check-role:normal', 'as' => 'normal.'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::resource('/news', NormalNewsController::class);
});

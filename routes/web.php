<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\KehadiranController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['middleware' => 'auth'])->group(function () {
    Route::get('/resep', function () {
        return view('resep.resep');
    });
    Route::resource('/supplier', SupplierController::class);
    Route::resource('/bahan', BahanController::class);
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('/kehadiran', KehadiranController::class);
});


require __DIR__.'/auth.php';

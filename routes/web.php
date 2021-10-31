<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SupplierController;
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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', function(){
        return view('dashboard');
    });

    Route::group(['middleware' => 'hakakses:admin,user'], function(){
        Route::resource('/supplier', SupplierController::class);
        Route::resource('/resep', ResepController::class);
        Route::resource('/bahan', BahanController::class);
    });

    Route::group(['middleware' => 'hakakses:admin,hr'], function(){
        Route::resource('/karyawan', KaryawanController::class);
        Route::resource('/kehadiran', KehadiranController::class);

    });

    Route::group(['middleware' => 'hakakses:admin'], function () {
        Route::resource('/gaji', GajiController::class);
    });
});


require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\ResepController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\MasterGajiController;
use App\Http\Controllers\ResepDetailsController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TunjanganGajiController;

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

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/riwayat', RiwayatController::class);
    Route::resource('/profile', ProfileController::class);

    Route::group(['middleware' => 'hakakses:admin,user'], function(){
        // resep
        Route::resource('/resep', ResepController::class);
        Route::post('/tambahCart', [ResepController::class, 'cartSession'])->name('tambahCart');
        Route::get('/resepcart', [ResepController::class, 'Cart'])->name('resepcart');
        Route::post('/updateresep', [ResepController::class, 'updateToCart'])->name('updateresep');
        Route::delete('/hapusresep', [ResepController::class, 'deleteFromCart'])->name('hapusresep');
        Route::get('/clearcart', [ResepController::class, 'clearCart'])->name('clearcart');

        // resepdetails
        Route::resource('/resepdetails', ResepDetailsController::class);
        Route::post('/tambaheditresep', [ResepDetailsController::class, 'tambaheditresep'])->name('tambaheditresep');
        Route::get('/reseppdf/{id}', [ResepDetailsController::class, 'exportresep'])->name('exportresep');

        // bahan
        Route::resource('/bahan', BahanController::class);

        // supplier
        Route::resource('/supplier', SupplierController::class);
        Route::get('/supplierexport', [SupplierController::class, 'export'])->name('supplierexport');
        Route::post('/supplierimport', [SupplierController::class, 'import'])->name('supplierimport');
    });

    Route::group(['middleware' => 'hakakses:admin,hr'], function(){
        Route::resource('/karyawan', KaryawanController::class);
        Route::resource('/kehadiran', KehadiranController::class);
        Route::get('/kehadiranexport', [KehadiranController::class, 'export'])->name('kehadiranexport');


    });

    Route::group(['middleware' => 'hakakses:admin'], function () {
        Route::resource('/gaji', GajiController::class);
        Route::get('/gaji-pdf/{id}', [GajiController::class, 'exportPDF'])->name('gajiexport');
        Route::resource('/mastergaji', MasterGajiController::class);
        Route::resource('/tunjangangaji', TunjanganGajiController::class);
    });
});


require __DIR__.'/auth.php';

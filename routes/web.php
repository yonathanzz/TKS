<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\DetailNotaBeliController;
use App\Http\Controllers\DetailNotaJualController;
use App\Http\Controllers\NotaBeliController;
use App\Http\Controllers\NotaJualController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\MetodePembayaranController;
use App\Models\DetailNotaBeli;
use App\Models\DetailNotaJual;
use App\Models\MetodePembayaran;
use App\Models\NotaBeli;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('exampleview');
    });

    Route::get('/barang', function () {
        return view('inventory.barang');
    });

    Route::post('/barang/getEditForm', 'BarangController@getEditForm')->name('barang.getEditForm');

    Route::get('/detailNotaBeli/{notaID}/products', [DetailNotaBeliController::class, 'productsFromNota'])->name('detailNotaBeli.productsFromNota');
    Route::get('/detailNotaJual/{notaID}/products', [DetailNotaJualController::class, 'productsFromNota'])->name('detailNotaJual.productsFromNota');

    Route::resource('barang', BarangController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('retur', ReturController::class);
    Route::resource('pembelian', NotaBeliController::class);
    Route::resource('detailNotaBeli', DetailNotaBeliController::class);
    Route::resource('penjualan', NotaJualController::class);
    Route::resource('detailNotaJual', DetailNotaJualController::class);
    Route::resource('metode_pembayaran', MetodePembayaranController::class);

    route::get('/createPenjualan', [NotaJualController::class, 'createPenjualan'])->name('notajual.createPenjualan');
    Route::post('/penjualan/getNotaDetailsByBarangId', [NotaJualController::class, 'getNotaDetailsByBarangId'])
    ->name('penjualan.getNotaDetailsByBarangId');

    // Route::post('/login', 'LoginController@login')->name('login');

    Route::get('/search', [BarangController::class, 'search'])->name('barang.search');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SupplierController;

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
    return view('exampleview');
});

Route::get('/barang', function () {
    return view('inventory.barang');
});

Route::resource('barang', BarangController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('retur', ReturController::class);

// Route::post('/login', 'LoginController@login')->name('login');

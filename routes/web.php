<?php

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

Route::get('/', function () {
    return view('exampleview');
});

Route::get('/product', function () {
    return view('inventory.product');
});

Route::post('/login', 'LoginController@login')->name('login');
Route::get('/barang', 'BarangController@index')->name('barang');

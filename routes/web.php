<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\TransaksiController;
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
    return view('welcome');
});


Route::get('export/supplier/pdf', [SupplierController::class, 'exportPdf'])->name('download.supplier.pdf');

Route::get('export/barang/pdf', [BarangController::class, 'exportPdf'])->name('download.barang.pdf');

Route::get('export/transaksi/pdf', [TransaksiController::class, 'exportPdf'])->name('download.transaksi.pdf');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\PenjualanController;

Route::get("/", function () {
    return redirect()->route("dashboard.index");
});

Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");
Route::resource("produk", ProdukController::class);
Route::resource("pelanggan", PelangganController::class);
Route::resource("penjualan", PenjualanController::class);
Route::get("waktu", [WaktuController::class, "index"])->name("waktu.index");
Route::post("waktu", [WaktuController::class, "store"])->name("waktu.store");


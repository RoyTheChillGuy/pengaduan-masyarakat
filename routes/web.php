<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\LaporanIndex;
use App\Http\Controllers\Warga\LaporanController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;

Route::get('/', function () {
    return view('warga.homepage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','role:warga'])->group(function () {         
    Route::view('/warga/homepage', 'warga.homepage')->name('warga.home');     
    Route::view('/warga/laporan/create', 'warga.laporan.create')->name('warga.laporan.create');
    Route::get('/warga/laporan', [LaporanController::class, 'index'])->name('warga.laporan.index');

});

Route::middleware(['auth','role:admin'])->group(function () {        // [6] Grup admin
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard'); // [7] Dashboard admin
    
    // Admin Laporan Routes
    Route::get('/admin/laporan/diproses', [AdminLaporanController::class, 'diproses'])->name('admin.laporan.diproses');
    Route::get('/admin/laporan/selesai', [AdminLaporanController::class, 'selesai'])->name('admin.laporan.selesai');
    Route::patch('/admin/laporan/{laporan}/status', [AdminLaporanController::class, 'updateStatus'])->name('admin.laporan.update-status');
});



require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PdfController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class,'index'])
        ->name('dashboard');

    Route::resource('agenda', AgendaController::class);

    Route::get('/laporan', [LaporanController::class,'index'])
        ->name('laporan.index');

    Route::post('/laporan/cetak', [LaporanController::class,'cetak'])
        ->name('laporan.cetak');

        
    Route::post('/extract-pdf', [PdfController::class, 'extract'])
    ->name('pdf.extract');
});

require __DIR__.'/auth.php';
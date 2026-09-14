<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserAgendaController;


Route::get('/', function () {

    return redirect()->route('login');

});


Route::middleware('auth')->group(function () {

    

    Route::middleware('role:admin')->group(function () {

        // Dashboard Admin
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');


        // Data Agenda Admin
        Route::resource('agenda', AgendaController::class);


        // Cetak Laporan Admin
        Route::get('/laporan', [LaporanController::class, 'index'])
            ->name('laporan.index');

        Route::post('/laporan/cetak', [LaporanController::class, 'cetak'])
            ->name('laporan.cetak');


        // OCR / Extract PDF
        Route::post('/extract-pdf', [PdfController::class, 'extract'])
            ->name('pdf.extract');

    });


   

    Route::middleware('role:user')->group(function () {

        // Dashboard User
        Route::get('/dashboard-user', [UserDashboardController::class, 'index'])
            ->name('dashboard.user');


        // Data Agenda User
        Route::get('/agenda-user', [UserAgendaController::class, 'index'])
            ->name('user.agenda.index');


        // Detail Agenda User
        Route::get('/agenda-user/{agenda}', [UserAgendaController::class, 'show'])
            ->name('user.agenda.show');


        // Cetak Laporan User
        Route::get('/laporan-user', [LaporanController::class, 'index'])
            ->name('user.laporan.index');

        Route::post('/laporan-user/cetak', [LaporanController::class, 'cetak'])
            ->name('user.laporan.cetak');

    });

});


require __DIR__.'/auth.php';
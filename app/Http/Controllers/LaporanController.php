<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Jika route yang dipanggil adalah laporan-user,
        // tampilkan halaman laporan untuk pengguna.
        if ($request->routeIs('user.laporan.index')) {
            return view('user.laporan.index');
        }

        // Selain itu tetap gunakan halaman laporan Admin.
        return view('laporan.index');
    }

    public function cetak(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        $agendas = Agenda::whereBetween('tanggal', [
            $request->tanggal_awal,
            $request->tanggal_akhir
        ])
        ->orderBy('tanggal', 'asc')
        ->orderBy('jam_mulai', 'asc')
        ->get();

        // Laporan User
        if ($request->routeIs('user.laporan.cetak')) {

            $pdf = Pdf::loadView('user.laporan.pdf', [
                'agendas' => $agendas,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
            ]);

            return $pdf->stream('laporan-agenda-user.pdf');
        }

        // Laporan Admin
        $pdf = Pdf::loadView('laporan.pdf', [
            'agendas' => $agendas,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return $pdf->stream('laporan-agenda.pdf');
    }
}
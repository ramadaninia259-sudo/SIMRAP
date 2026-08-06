<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
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
        ])->orderBy('tanggal', 'asc')->get();

        $pdf = Pdf::loadView('laporan.pdf', [
            'agendas' => $agendas,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return $pdf->stream('laporan-agenda.pdf');
    }
}
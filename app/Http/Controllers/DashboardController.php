<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAgenda = Agenda::count();

        $agendaHariIni = Agenda::whereDate('tanggal', now()->toDateString())->count();

        $agendaSelesai = Agenda::where('status', 'Selesai')->count();

        $agendaTerbaru = Agenda::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalAgenda',
            'agendaHariIni',
            'agendaSelesai',
            'agendaTerbaru'
        ));
    }
}
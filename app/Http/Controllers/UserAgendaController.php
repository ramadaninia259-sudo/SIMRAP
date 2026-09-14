<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class UserAgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::orderBy('tanggal', 'asc')
                         ->orderBy('jam_mulai', 'asc')
                         ->get();

        return view('user.agenda.index', compact('agendas'));
    }

    public function show(Agenda $agenda)
    {
        return view('user.agenda.show', compact('agenda'));
    }
}
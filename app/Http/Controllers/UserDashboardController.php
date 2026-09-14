<?php

namespace App\Http\Controllers;

use App\Models\Agenda;

class UserDashboardController extends Controller
{
    public function index()
    {
        $agenda = Agenda::orderBy('tanggal', 'asc')
                        ->orderBy('jam_mulai', 'asc')
                        ->get();

        return view('user.dashboard', compact('agenda'));
    }
}
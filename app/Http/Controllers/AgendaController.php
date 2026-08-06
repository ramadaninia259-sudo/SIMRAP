<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agendas = Agenda::all();
        return view('agenda.index', compact('agendas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agenda.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'judul_rapat'   => 'required',
        'tanggal'       => 'required',
        'jam_mulai'     => 'required',
        'jam_selesai'   => 'required',
        'tempat'        => 'required',
        'pimpinan_rapat'=> 'required',
        'status'        => 'required',
        'file_surat'    => 'nullable|mimes:pdf|max:5120'
    ]);

    $namaFile = null;

    if ($request->hasFile('file_surat')) {

        $namaFile = time().'_'.$request->file('file_surat')->getClientOriginalName();

        $request->file('file_surat')
                ->storeAs('surat', $namaFile, 'public');
    }

    Agenda::create([

        'judul_rapat' => $request->judul_rapat,
        'tanggal' => $request->tanggal,
        'jam_mulai' => $request->jam_mulai,
        'jam_selesai' => $request->jam_selesai,
        'tempat' => $request->tempat,
        'pimpinan_rapat' => $request->pimpinan_rapat,
        'keterangan' => $request->keterangan,
        'status' => $request->status,
        'file_surat' => $namaFile,

    ]);

    return redirect()
        ->route('agenda.index')
        ->with('success', 'Data agenda berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Agenda $agenda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agenda $agenda)
    {
        return view('agenda.edit', compact('agenda'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agenda $agenda)
{
    $request->validate([
        'judul_rapat' => 'required',
        'tanggal' => 'required',
        'jam_mulai' => 'required',
        'jam_selesai' => 'required',
        'tempat' => 'required',
        'pimpinan_rapat' => 'required',
        'status' => 'required'
    ]);

    $agenda->update([
        'judul_rapat'    => $request->judul_rapat,
        'tanggal'        => $request->tanggal,
        'jam_mulai'      => $request->jam_mulai,
        'jam_selesai'    => $request->jam_selesai,
        'tempat'         => $request->tempat,
        'pimpinan_rapat' => $request->pimpinan_rapat,
        'keterangan'     => $request->keterangan,
        'status'         => $request->status,
    ]);

    return redirect()
        ->route('agenda.index')
        ->with('success', 'Data agenda berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agenda $agenda)
    {
        $agenda->delete();

        return redirect()->route('agenda.index')
            ->with('success', 'Data agenda berhasil dihapus.');
    }
}
@extends('layouts.simrap')

@section('title', 'Detail Agenda Rapat')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="mb-0 fw-bold">

                <i class="bi bi-calendar-event text-success"></i>

                Detail Agenda Rapat

            </h5>

            <a href="{{ route('user.agenda.index') }}"
               class="btn btn-secondary btn-sm">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

    <div class="card-body p-4">

        <div class="row g-4">

            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Judul Rapat
                </label>

                <div class="form-control bg-light">
                    {{ $agenda->judul_rapat }}
                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Tanggal
                </label>

                <div class="form-control bg-light">

                    {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Jam Rapat
                </label>

                <div class="form-control bg-light">

                    {{ substr($agenda->jam_mulai, 0, 5) }}

                    -

                    {{ substr($agenda->jam_selesai, 0, 5) }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Tempat
                </label>

                <div class="form-control bg-light">

                    {{ $agenda->tempat }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Pimpinan Rapat
                </label>

                <div class="form-control bg-light">

                    {{ $agenda->pimpinan_rapat }}

                </div>

            </div>


            <div class="col-md-6">

                <label class="form-label fw-bold">
                    Status
                </label>

                <div class="form-control bg-light">

                    @if($agenda->status === 'Terjadwal')

                        <span class="badge bg-success">
                            Terjadwal
                        </span>

                    @elseif($agenda->status === 'Selesai')

                        <span class="badge bg-primary">
                            Selesai
                        </span>

                    @else

                        <span class="badge bg-warning text-dark">
                            {{ $agenda->status }}
                        </span>

                    @endif

                </div>

            </div>


            <div class="col-12">

                <label class="form-label fw-bold">
                    Keterangan
                </label>

                <div class="form-control bg-light"
                     style="min-height:100px;">

                    {{ $agenda->keterangan ?: 'Tidak ada keterangan.' }}

                </div>

            </div>


            @if($agenda->file_surat)

            <div class="col-12">

                <label class="form-label fw-bold">
                    Surat Undangan
                </label>

                <div>

                    <a href="{{ asset('storage/surat/'.$agenda->file_surat) }}"
                       target="_blank"
                       class="btn btn-primary">

                        <i class="bi bi-file-earmark-pdf"></i>

                        Lihat Surat PDF

                    </a>

                </div>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection
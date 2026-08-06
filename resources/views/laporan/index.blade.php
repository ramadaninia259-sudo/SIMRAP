@extends('layouts.simrap')

@section('title', 'Cetak Laporan')

@section('content')

<div class="card shadow-sm border-0">

    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">

        <div>
            <h4 class="mb-1 fw-bold text-success">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                Cetak Laporan Agenda
            </h4>

            <small class="text-muted">
                Pilih periode tanggal untuk mencetak laporan agenda rapat.
            </small>
        </div>

    </div>

    <div class="card-body">

        <form action="{{ route('laporan.cetak') }}" method="POST">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-calendar-event"></i>
                        Tanggal Awal
                    </label>

                    <input
                        type="date"
                        name="tanggal_awal"
                        class="form-control"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        <i class="bi bi-calendar-check"></i>
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        class="form-control"
                        required>

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-end">

                <button
                    type="submit"
                    class="btn btn-danger">

                    <i class="bi bi-file-earmark-pdf-fill"></i>

                    Cetak Laporan PDF

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
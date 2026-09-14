@extends('layouts.simrap')

@section('title', 'Cetak Laporan')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-header bg-white">

        <h5 class="mb-0 fw-bold">
            <i class="bi bi-printer text-success"></i>
            Cetak Laporan Agenda Rapat
        </h5>

    </div>

    <div class="card-body p-4">

        <p class="text-muted mb-4">
            Pilih periode tanggal untuk mencetak laporan agenda rapat.
        </p>

        <form action="{{ route('user.laporan.cetak') }}" method="POST">

            @csrf

            <div class="row g-4">

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Tanggal Awal
                    </label>

                    <input
                        type="date"
                        name="tanggal_awal"
                        class="form-control"
                        value="{{ old('tanggal_awal') }}"
                        required>

                </div>

                <div class="col-md-6">

                    <label class="form-label fw-semibold">
                        Tanggal Akhir
                    </label>

                    <input
                        type="date"
                        name="tanggal_akhir"
                        class="form-control"
                        value="{{ old('tanggal_akhir') }}"
                        required>

                </div>

            </div>

            @if($errors->any())

                <div class="alert alert-danger mt-4">

                    <ul class="mb-0">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <div class="mt-4">

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-file-earmark-pdf"></i>

                    Cetak PDF

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
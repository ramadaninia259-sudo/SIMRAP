@extends('layouts.simrap')

@section('title','Edit Agenda Rapat')

@section('content')

<div class="card">

    <div class="card-header">

        <h5 class="mb-0">
            Edit Agenda Rapat
        </h5>

    </div>

    <div class="card-body">

        <form action="{{ route('agenda.update',$agenda->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label class="form-label">Judul Rapat</label>

                <input
                    type="text"
                    name="judul_rapat"
                    class="form-control"
                    value="{{ $agenda->judul_rapat }}"
                    required>

            </div>

            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">Tanggal</label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ $agenda->tanggal }}"
                        required>

                </div>

                <div class="col-md-3">

                    <label class="form-label">Jam Mulai</label>

                    <input
                        type="time"
                        name="jam_mulai"
                        class="form-control"
                        value="{{ $agenda->jam_mulai }}"
                        required>

                </div>

                <div class="col-md-3">

                    <label class="form-label">Jam Selesai</label>

                    <input
                        type="time"
                        name="jam_selesai"
                        class="form-control"
                        value="{{ $agenda->jam_selesai }}"
                        required>

                </div>

            </div>

            <div class="mt-3">

                <label class="form-label">Tempat</label>

                <input
                    type="text"
                    name="tempat"
                    class="form-control"
                    value="{{ $agenda->tempat }}"
                    required>

            </div>

            <div class="mt-3">

                <label class="form-label">Pimpinan Rapat</label>

                <input
                    type="text"
                    name="pimpinan_rapat"
                    class="form-control"
                    value="{{ $agenda->pimpinan_rapat }}"
                    required>

            </div>

            <div class="mt-3">

                <label class="form-label">Keterangan</label>

                <textarea
                    name="keterangan"
                    class="form-control"
                    rows="4">{{ $agenda->keterangan }}</textarea>

            </div>

            <div class="mt-3">

                <label class="form-label">Status</label>

                <select
                    name="status"
                    class="form-select">

                    <option value="Terjadwal"
                        {{ $agenda->status=='Terjadwal' ? 'selected' : '' }}>
                        Terjadwal
                    </option>

                    <option value="Selesai"
                        {{ $agenda->status=='Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="Ditunda"
                        {{ $agenda->status=='Ditunda' ? 'selected' : '' }}>
                        Ditunda
                    </option>

                </select>

            </div>

            <div class="mt-4">

                <a
                    href="{{ route('agenda.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

                <button
                    class="btn btn-primary">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection
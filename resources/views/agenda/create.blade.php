@extends('layouts.simrap')

@section('title','Tambah Agenda Rapat')

@section('content')

<div class="card">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">
            Tambah Agenda Rapat
        </h4>

    </div>

    <div class="card-body">

        <form action="{{ route('agenda.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="mb-3">

                <label class="form-label">
                    Judul Rapat
                </label>

                <input
                    type="text"
                    id="judul_rapat"
                    name="judul_rapat"
                    class="form-control"
                    required>

            </div>


            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input
                        type="date"
                        id="tanggal"
                        name="tanggal"
                        class="form-control"
                        required>

                </div>


                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Jam Mulai
                    </label>

                    <input
                        type="time"
                        id="jam_mulai"
                        name="jam_mulai"
                        class="form-control"
                        required>

                </div>


                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Jam Selesai
                    </label>

                    <input
                        type="time"
                        id="jam_selesai"
                        name="jam_selesai"
                        class="form-control"
                        required>

                </div>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Tempat
                </label>

                <input
                    type="text"
                    id="tempat"
                    name="tempat"
                    class="form-control"
                    required>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Pimpinan Rapat
                </label>

                <input
                    type="text"
                    id="pimpinan_rapat"
                    name="pimpinan_rapat"
                    class="form-control"
                    required>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Keterangan
                </label>

                <textarea
                    id="keterangan"
                    name="keterangan"
                    class="form-control"
                    rows="3"></textarea>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Surat Undangan Rapat (PDF)
                </label>

                <input
                    type="file"
                    id="file_surat"
                    name="file_surat"
                    class="form-control"
                    accept=".pdf">

                <small class="text-muted">
                    Format PDF, ukuran maksimal 5 MB.
                </small>

            </div>


            <div class="mb-4">

                <label class="form-label">
                    Status
                </label>

                <select
                    name="status"
                    class="form-select">

                    <option value="Terjadwal">
                        Terjadwal
                    </option>

                    <option value="Selesai">
                        Selesai
                    </option>

                    <option value="Ditunda">
                        Ditunda
                    </option>

                </select>

            </div>


            <a
                href="{{ route('agenda.index') }}"
                class="btn btn-secondary">

                Kembali

            </a>


            <button
                type="submit"
                class="btn btn-success">

                Simpan

            </button>

        </form>

    </div>

</div>

@endsection
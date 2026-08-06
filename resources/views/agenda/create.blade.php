@extends('layouts.simrap')

@section('title','Tambah Agenda Rapat')

@section('content')

<div class="card">

    <div class="card-header bg-success text-white">

        <h4 class="mb-0">Tambah Agenda Rapat</h4>

    </div>

    <div class="card-body">

        <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">

            @csrf

            <div class="mb-3">
                <label class="form-label">Judul Rapat</label>
                <input type="text"
                id="judul_rapat"
                name="judul_rapat"
                class="form-control"
                required>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date"
                    id="tanggal"
                    name="tanggal"
                    class="form-control"
                    required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Mulai</label>
                   <input type="time"
                    id="jam_mulai"
                    name="jam_mulai"
                    class="form-control"
                    required>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Jam Selesai</label>
                   <input type="time"
                    id="jam_selesai"
                    name="jam_selesai"
                    class="form-control"
                    required>
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Tempat</label>
                <input type="text"
                id="tempat"
                name="tempat"
                class="form-control"
                required>
            </div>

            <div class="mb-3">
                <label class="form-label">Pimpinan Rapat</label>
                <input type="text"
                id="pimpinan_rapat"
                name="pimpinan_rapat"
                class="form-control"
                required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea
                    id="keterangan"
                    name="keterangan"
                    class="form-control"
                    rows="3"></textarea>
            </div>
                        <div class="mb-3">
                <label class="form-label">Surat Undangan Rapat (PDF)</label>

                    <input type="file"
                        id="file_surat"
                        name="file_surat"
                        class="form-control"
                        accept=".pdf">

                        <small class="text-muted">
                         Format PDF, ukuran maksimal 5 MB.
                        </small>

            </div>

                <div class="mb-3">

                    <button type="button"
                         id="btnEkstrak"
                        class="btn btn-info">

                            <i class="bi bi-search"></i>

                            Ekstrak Data Surat

                    </button>

                </div>
            <div class="mb-4">
                <label class="form-label">Status</label>

                <select name="status" class="form-select">

                    <option value="Terjadwal">Terjadwal</option>

                    <option value="Selesai">Selesai</option>

                    <option value="Ditunda">Ditunda</option>

                </select>

            </div>
        
            <a href="{{ route('agenda.index') }}" class="btn btn-secondary">
                Kembali
            </a>

            <button type="submit" class="btn btn-success">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(document).ready(function () {

    $('#btnEkstrak').click(function () {

        let file = $('#file_surat')[0].files[0];

        if (!file) {
            alert('Silakan pilih file PDF terlebih dahulu.');
            return;
        }

        let formData = new FormData();

        formData.append('file_surat', file);
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({

            url: "{{ route('pdf.extract') }}",

            type: "POST",

            data: formData,

            processData: false,

            contentType: false,

            success: function (res) {

                console.log(res);

                alert(
                    "Judul Rapat : " + (res.judul_rapat || '-') + "\n\n" +
                    "Tanggal : " + (res.tanggal || '-') + "\n\n" +
                    "Jam Mulai : " + (res.jam_mulai || '-') + "\n\n" +
                    "Jam Selesai : " + (res.jam_selesai || '-') + "\n\n" +
                    "Tempat : " + (res.tempat || '-') + "\n\n" +
                    "Pimpinan Rapat : " + (res.pimpinan_rapat || '-') + "\n\n" +
                    "Keterangan : " + (res.keterangan || '-') + "\n\n" +
                    "Status : " + (res.status || '-')
                );

                // Judul
                $('#judul_rapat').val(res.judul_rapat);

                // Tempat
                $('#tempat').val(res.tempat);

                // Keterangan
                $('textarea[name="keterangan"]').val(res.keterangan);

                // ==========================
                // Tanggal
                // ==========================

                if(res.tanggal){

                    let hasil = res.tanggal
                        .replace("Senin /","")
                        .replace("Selasa /","")
                        .replace("Rabu /","")
                        .replace("Kamis /","")
                        .replace("Jumat /","")
                        .replace("Sabtu /","")
                        .replace("Minggu /","")
                        .trim();

                    let bulan = {
                        januari:'01',
                        februari:'02',
                        maret:'03',
                        april:'04',
                        mei:'05',
                        juni:'06',
                        juli:'07',
                        agustus:'08',
                        september:'09',
                        oktober:'10',
                        november:'11',
                        desember:'12'
                    };

                    let p = hasil.toLowerCase().split(' ');

                    if(p.length==3){

                        let tgl = p[0].padStart(2,'0');
                        let bln = bulan[p[1]];
                        let thn = p[2];

                        if(bln){

                            $('#tanggal').val(
                                thn+'-'+bln+'-'+tgl
                            );

                        }

                    }

                }

                // ==========================
                // Jam Mulai
                // ==========================

                if(res.jam_mulai){

                    $('#jam_mulai').val(res.jam_mulai);

                }

                // ==========================
                // Jam Selesai
                // ==========================

                if(res.jam_selesai){

                    $('#jam_selesai').val(res.jam_selesai);

                }

            },

            error:function(xhr){

                console.log(xhr.responseText);

                alert('Gagal membaca PDF');

            }

        });

    });

});

</script>

@endpush
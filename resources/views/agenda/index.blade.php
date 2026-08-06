@extends('layouts.simrap')

@section('title','Data Agenda Rapat')

@section('content')

<div class="d-flex justify-content-end mb-4">

    <a href="{{ route('agenda.create') }}" class="btn btn-success">
        <i class="bi bi-plus-circle"></i>
        Tambah Agenda
    </a>

</div>

@if(session('success'))

<div class="alert alert-success alert-dismissible fade show">

    {{ session('success') }}

    <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

</div>

@endif

<div class="card">

    <div class="card-body">

        <table id="tableAgenda" class="table table-hover table-bordered align-middle">

            <thead class="table-success">

            <tr>

                <th width="60">No</th>

                <th>Judul Rapat</th>

                <th>Tanggal</th>

                <th>Jam</th>

                <th>Tempat</th>

                <th>Pimpinan</th>

                <th>Surat</th>

                <th>Status</th>

                <th width="170">Aksi</th>

            </tr>

            </thead>

            <tbody>

            @forelse($agendas as $agenda)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td>{{ $agenda->judul_rapat }}</td>

                <td>{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d M Y') }}</td>

                <td>{{ substr($agenda->jam_mulai,0,5) }} - {{ substr($agenda->jam_selesai,0,5) }}</td>

                <td>{{ $agenda->tempat }}</td>

                <td>{{ $agenda->pimpinan_rapat }}</td>

                <td>

                    @if($agenda->file_surat)

                        <a href="{{ asset('storage/surat/'.$agenda->file_surat) }}"
                           target="_blank"
                           class="btn btn-success btn-sm">

                            <i class="bi bi-file-earmark-pdf"></i>
                            Lihat

                        </a>

                    @else

                        <span class="badge bg-danger">

                            Belum Upload

                        </span>

                    @endif

                </td>

                <td>

                    @if($agenda->status=='Terjadwal')

                        <span class="badge bg-success">

                            {{ $agenda->status }}

                        </span>

                    @elseif($agenda->status=='Selesai')

                        <span class="badge bg-primary">

                            {{ $agenda->status }}

                        </span>

                    @else

                        <span class="badge bg-warning text-dark">

                            {{ $agenda->status }}

                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('agenda.edit',$agenda->id) }}"
                       class="btn btn-warning btn-sm">

                        <i class="bi bi-pencil-square"></i>

                    </a>

                    <form action="{{ route('agenda.destroy',$agenda->id) }}"
                          method="POST"
                          class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus data ini?')">

                            <i class="bi bi-trash"></i>

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="9" class="text-center">

                    Belum ada data agenda.

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection

@push('scripts')

<script>

$(function(){

    $('#tableAgenda').DataTable({

        language:{

            search:"Cari Agenda :",

            lengthMenu:"Tampilkan _MENU_ data",

            zeroRecords:"Data tidak ditemukan",

            info:"Menampilkan _START_ - _END_ dari _TOTAL_ data",

            infoEmpty:"Belum ada data",

            paginate:{

                first:"Awal",

                last:"Akhir",

                next:">>",

                previous:"<<"

            }

        }

    });

});

</script>

@endpush
@extends('layouts.simrap')

@section('title', 'Dashboard Pengguna')

@section('content')

<div class="row g-4">

    <!-- Selamat Datang -->
    <div class="col-12">

        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">

                <div class="d-flex align-items-center">

                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:65px;height:65px;background:#E8F8F5;">

                        <i class="bi bi-person-circle fs-2 text-success"></i>

                    </div>

                    <div>

                        <h4 class="fw-bold mb-1">
                            Selamat Datang, {{ Auth::user()->name }}
                        </h4>

                        <p class="text-muted mb-0">
                            Selamat datang di Sistem Informasi Manajemen Rapat.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Ringkasan -->

<div class="row g-4 mt-1">

    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center">

                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:55px;height:55px;background:#E8F8F5;">

                        <i class="bi bi-calendar-event-fill fs-4 text-success"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Total Agenda
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $agenda->count() }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center">

                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:55px;height:55px;background:#EAF4FF;">

                        <i class="bi bi-calendar-check-fill fs-4 text-primary"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Agenda Terjadwal
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $agenda->where('status', 'Terjadwal')->count() }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body p-4">

                <div class="d-flex align-items-center">

                    <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                         style="width:55px;height:55px;background:#FFF5E6;">

                        <i class="bi bi-check-circle-fill fs-4 text-warning"></i>

                    </div>

                    <div>

                        <small class="text-muted">
                            Agenda Selesai
                        </small>

                        <h3 class="fw-bold mb-0">
                            {{ $agenda->where('status', 'Selesai')->count() }}
                        </h3>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<!-- Daftar Agenda -->

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0 fw-bold">

            <i class="bi bi-calendar2-week text-success"></i>

            Daftar Agenda Rapat

        </h5>

    </div>


    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-success">

                    <tr>

                        <th width="60">No</th>

                        <th>Judul Rapat</th>

                        <th>Tanggal</th>

                        <th>Jam</th>

                        <th>Tempat</th>

                        <th>Pimpinan</th>

                        <th>Status</th>

                    </tr>

                </thead>


                <tbody>

                @forelse($agenda as $item)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $item->judul_rapat }}
                            </strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </td>

                        <td>
                            {{ substr($item->jam_mulai, 0, 5) }}
                            -
                            {{ substr($item->jam_selesai, 0, 5) }}
                        </td>

                        <td>
                            {{ $item->tempat }}
                        </td>

                        <td>
                            {{ $item->pimpinan_rapat }}
                        </td>

                        <td>

                            @if($item->status === 'Terjadwal')

                                <span class="badge bg-success">
                                    Terjadwal
                                </span>

                            @elseif($item->status === 'Selesai')

                                <span class="badge bg-primary">
                                    Selesai
                                </span>

                            @else

                                <span class="badge bg-warning text-dark">
                                    Ditunda
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="text-center py-5">

                            <i class="bi bi-calendar-x fs-2 text-muted"></i>

                            <div class="mt-2 text-muted">
                                Belum ada agenda rapat.
                            </div>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
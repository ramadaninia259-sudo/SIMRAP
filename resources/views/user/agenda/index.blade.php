@extends('layouts.simrap')

@section('title', 'Data Agenda Rapat')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h3 class="mb-1">Data Agenda Rapat</h3>
        <p class="text-muted mb-0">
            Informasi agenda rapat yang telah dijadwalkan.
        </p>
    </div>

</div>

<div class="card border-0 shadow-sm">

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
                        <th>Pimpinan Rapat</th>
                        <th>Status</th>
                        <th width="100">Detail</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($agendas as $agenda)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            <strong>
                                {{ $agenda->judul_rapat }}
                            </strong>
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                        </td>

                        <td>
                            {{ substr($agenda->jam_mulai, 0, 5) }}
                            -
                            {{ substr($agenda->jam_selesai, 0, 5) }}
                        </td>

                        <td>
                            {{ $agenda->tempat }}
                        </td>

                        <td>
                            {{ $agenda->pimpinan_rapat }}
                        </td>

                        <td>

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

                        </td>

                        <td>

                            <a href="{{ route('user.agenda.show', $agenda->id) }}"
                               class="btn btn-primary btn-sm">

                                <i class="bi bi-eye"></i>
                                Lihat

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-4 text-muted">

                            Belum ada data agenda rapat.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
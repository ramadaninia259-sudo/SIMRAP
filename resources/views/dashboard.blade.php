@extends('layouts.simrap')

@section('title', 'Dashboard')

@section('content')

<div class="row g-4">

    <!-- Total Agenda -->
    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:70px;height:70px;background:#E8F8F5;">

                    <i class="bi bi-calendar-event-fill fs-2 text-success"></i>

                </div>

                <div>

                    <h6 class="text-muted mb-1">
                        Total Agenda
                    </h6>

                    <h2 class="fw-bold mb-1">
                        {{ $totalAgenda }}
                    </h2>

                    <small class="text-muted">
                        Total agenda rapat yang tercatat
                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- Agenda Hari Ini -->
    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:70px;height:70px;background:#EAF4FF;">

                    <i class="bi bi-calendar-check-fill fs-2 text-primary"></i>

                </div>

                <div>

                    <h6 class="text-muted mb-1">
                        Agenda Hari Ini
                    </h6>

                    <h2 class="fw-bold mb-1">
                        {{ $agendaHariIni }}
                    </h2>

                    <small class="text-muted">
                        Agenda sesuai tanggal hari ini
                    </small>

                </div>

            </div>

        </div>

    </div>

    <!-- Agenda Selesai -->
    <div class="col-lg-4 col-md-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body d-flex align-items-center">

                <div class="rounded-circle d-flex align-items-center justify-content-center me-3"
                     style="width:70px;height:70px;background:#FFF5E6;">

                    <i class="bi bi-check-circle-fill fs-2 text-warning"></i>

                </div>

                <div>

                    <h6 class="text-muted mb-1">
                        Agenda Selesai
                    </h6>

                    <h2 class="fw-bold mb-1">
                        {{ $agendaSelesai }}
                    </h2>

                    <small class="text-muted">
                        Agenda yang telah selesai
                    </small>

                </div>

            </div>

        </div>

    </div>

</div>
<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white">

        <h5 class="mb-0 fw-bold">

            <i class="bi bi-bar-chart-fill text-success"></i>

            Statistik Agenda

        </h5>

    </div>

    <div class="card-body">

        <canvas id="chartAgenda" height="90"></canvas>

    </div>

</div>

<!-- Agenda Terbaru -->

<div class="card border-0 shadow-sm mt-4">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0 fw-bold">

            <i class="bi bi-clock-history text-success"></i>

            Agenda Terbaru

        </h5>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-success">

                    <tr>

                        <th width="70">No</th>

                        <th>Judul Rapat</th>

                        <th width="160">Tanggal</th>

                        <th width="140">Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($agendaTerbaru as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->judul_rapat }}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                        </td>

                        <td>

                            @if($item->status=='Terjadwal')

                                <span class="badge bg-success">

                                    {{ $item->status }}

                                </span>

                            @elseif($item->status=='Selesai')

                                <span class="badge bg-primary">

                                    {{ $item->status }}

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    {{ $item->status }}

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-4">

                            <i class="bi bi-inbox fs-3 text-secondary"></i>

                            <br>

                            Belum ada data agenda.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('chartAgenda');

new Chart(ctx,{

type:'bar',

data:{

labels:[
'Total',
'Hari Ini',
'Selesai'
],

datasets:[{

label:'Jumlah Agenda',

data:[
{{ $totalAgenda }},
{{ $agendaHariIni }},
{{ $agendaSelesai }}
],

backgroundColor:[
'#198754',
'#0d6efd',
'#ffc107'
]

}]

},

options:{

responsive:true,

plugins:{

legend:{
display:false
}

}

}

});

</script>

@endpush
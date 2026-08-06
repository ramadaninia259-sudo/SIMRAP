<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    font-size:11px;
    margin:25px;
    color:#000;
}

.header{
    text-align:center;
    margin-bottom:10px;
}

.header h2{
    margin:0;
    font-size:18px;
}

.header h3{
    margin:3px 0;
    font-size:15px;
}

.header p{
    margin:2px;
    font-size:11px;
}

.line{
    border-top:2px solid #000;
    border-bottom:1px solid #000;
    margin-top:10px;
    margin-bottom:20px;
}

.judul{
    text-align:center;
    margin-bottom:15px;
}

.judul h3{
    margin:0;
    font-size:17px;
}

.judul p{
    margin-top:6px;
    font-size:12px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,th,td{
    border:1px solid black;
}

th{
    background:#e8e8e8;
    text-align:center;
    font-weight:bold;
}

th,td{
    padding:6px;
    vertical-align:top;
}

.no{
    width:5%;
    text-align:center;
}

.judulkolom{
    width:25%;
}

.tanggal{
    width:12%;
    text-align:center;
}

.jam{
    width:12%;
    text-align:center;
}

.tempat{
    width:25%;
}

.pimpinan{
    width:13%;
}

.status{
    width:8%;
    text-align:center;
}

.footer{
    margin-top:40px;
    text-align:right;
    font-size:11px;
}

</style>

</head>

<body>

<div class="header">

    <h2>PEMERINTAH PROVINSI SUMATERA UTARA</h2>

    <h3>DINAS KOMUNIKASI DAN INFORMATIKA</h3>

    <p>SISTEM INFORMASI MANAJEMEN RAPAT (SIMRAP)</p>

</div>

<div class="line"></div>

<div class="judul">

    <h3>LAPORAN AGENDA RAPAT</h3>

    <p>

        Periode

        <br>

        {{ \Carbon\Carbon::parse($tanggal_awal)->translatedFormat('d F Y') }}

        s/d

        {{ \Carbon\Carbon::parse($tanggal_akhir)->translatedFormat('d F Y') }}

    </p>

</div>

<table>

<thead>

<tr>

<th class="no">No</th>

<th class="judulkolom">Judul</th>

<th class="tanggal">Tanggal</th>

<th class="jam">Jam</th>

<th class="tempat">Tempat</th>

<th class="pimpinan">Pimpinan</th>

<th class="status">Status</th>

</tr>

</thead>

<tbody>

@forelse($agendas as $agenda)

<tr>

<td class="no">
{{ $loop->iteration }}
</td>

<td>
{{ $agenda->judul_rapat }}
</td>

<td class="tanggal">
{{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d M Y') }}
</td>

<td class="jam">

{{ substr($agenda->jam_mulai,0,5) }}

-

@if($agenda->jam_selesai=="00:00:00" || empty($agenda->jam_selesai))

Selesai

@else

{{ substr($agenda->jam_selesai,0,5) }}

@endif

</td>

<td>
{{ $agenda->tempat }}
</td>

<td>
{{ $agenda->pimpinan_rapat }}
</td>

<td class="status">
{{ $agenda->status }}
</td>

</tr>

@empty

<tr>

<td colspan="7" style="text-align:center">

Tidak ada data.

</td>

</tr>

@endforelse

</tbody>

</table>

<div class="footer">

Dicetak pada :

{{ \Carbon\Carbon::now()->translatedFormat('d F Y H:i') }}

</div>

</body>

</html>
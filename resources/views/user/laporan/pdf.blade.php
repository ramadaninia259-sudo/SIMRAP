<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <style>

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background: #dddddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        .judul {
            text-align: center;
            margin-bottom: 20px;
        }

    </style>

</head>

<body>

<div class="judul">

    <h2>
        LAPORAN AGENDA RAPAT
    </h2>

    <p>

        Periode

        <br>

        {{ $tanggal_awal }}

        s/d

        {{ $tanggal_akhir }}

    </p>

</div>

<table>

    <thead>

        <tr>

            <th>No</th>

            <th>Judul</th>

            <th>Tanggal</th>

            <th>Jam</th>

            <th>Tempat</th>

            <th>Pimpinan</th>

            <th>Status</th>

        </tr>

    </thead>

    <tbody>

        @forelse($agendas as $agenda)

            <tr>

                <td>
                    {{ $loop->iteration }}
                </td>

                <td>
                    {{ $agenda->judul_rapat }}
                </td>

                <td>
                    {{ $agenda->tanggal }}
                </td>

                <td>
                    {{ $agenda->jam_mulai }} -
                    {{ $agenda->jam_selesai }}
                </td>

                <td>
                    {{ $agenda->tempat }}
                </td>

                <td>
                    {{ $agenda->pimpinan_rapat }}
                </td>

                <td>
                    {{ $agenda->status }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="7">
                    Tidak ada data.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>

</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Anak</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Laporan Pemeriksaan Anak</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Anak</th>
                <th>Berat (kg)</th>
                <th>Tinggi (cm)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periksaAnaks as $key => $periksaAnak)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($periksaAnak->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $periksaAnak->anak->nama_anak }}</td>
                    <td>{{ $periksaAnak->berat }}</td>
                    <td>{{ $periksaAnak->tinggi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

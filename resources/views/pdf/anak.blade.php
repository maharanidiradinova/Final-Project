<!DOCTYPE html>
<html>
<head>
    <title>Data Anak</title>
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
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Data Anak</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Anak</th>
                <th>Nama Orang Tua</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Anak-ke</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anaks as $index => $anak)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $anak->nama_anak }}</td>
                <td>{{ $anak->nama_ortu }}</td>
                <td>{{ $anak->tempat_lahir }}</td>
                <td>{{ $anak->tgl_lahir->isoFormat('dddd, D MMMM Y') }}</td>
                <td>{{ $anak->jenis_kelamin }}</td>
                <td>{{ $anak->anak_ke }}</td>
                <td>{{ $anak->umur }} Tahun</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

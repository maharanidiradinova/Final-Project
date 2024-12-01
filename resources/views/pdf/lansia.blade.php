<!DOCTYPE html>
<html>
<head>
    <title>Data Lansia</title>
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
    <h1>Data Lansia</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lansia</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Umur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lansias as $index => $lansia)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $anak->nama_lansia }}</td>
                <td>{{ $anak->tgl_lahir->isoFormat('dddd, D MMMM Y') }}</td>
                <td>{{ $anak->jenis_kelamin }}</td>
                <td>{{ $anak->umur }} Tahun</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

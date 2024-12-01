<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Imunisasi Anak</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div class="header">
        <h1>Posyandu Sarana Sehat</h1>
        <p class="header-caption fw-bold">Laporan Bulanan Imunisasi Anak</p>
        <p class="header-address">Alamat: Kampung Bawah Magek, Kecamatan Kamang Magek, Kabupaten Agam</p>
    </div>

    @foreach($imunisasis->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->tanggal)->format('F Y');
    }) as $bulanTahun => $data)
        <h3>{{ $bulanTahun }}</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Jenis Imunisasi</th>
                    <th>Booster</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $imunisasi)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $imunisasi->anak->nama_anak }}</td>
                        <td>{{ $imunisasi->jenis_imunisasi }}</td>
                        <td>{{ $imunisasi->booster }}</td>
                        <td>{{ $imunisasi->ket_imun }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach

    <div class="footer">
        <p>&copy; Posyandu Sarana Sehat</p>
    </div>
</body>
</html>

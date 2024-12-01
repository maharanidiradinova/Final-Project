<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Lansia</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div class="header">
        <h1>Posyandu Sarana Sehat</h1>
        <p class="header-caption fw-bold">Laporan Bulanan Pemeriksaan Lansia</p>
        <p class="header-address">Alamat: Kampung Bawah Magek, Kecamatan Kamang Magek, Kabupaten Agam</p>
    </div>

    @foreach($periksaLansias->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->tanggal)->format('F Y');
    }) as $bulanTahun => $data)
        <h3>{{ $bulanTahun }}</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lansia</th>
                    <th>Berat (kg)</th>
                    <th>Tekanan Darah</th>
                    <th>Lingkar Perut (cm)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $periksaLansia)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $periksaLansia->lansia->nama_lansia }}</td>
                        <td>{{ $periksaLansia->berat }}</td>
                        <td>{{ $periksaLansia->tekanan_darah }}</td>
                        <td>{{ $periksaLansia->lingkar_perut }}</td>
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

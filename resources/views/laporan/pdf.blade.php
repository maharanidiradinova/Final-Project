<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemeriksaan Anak</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div class="header">
        <h1>Posyandu Sarana Sehat</h1>
        <p class="header-caption">Laporan Bulanan Pemeriksaan Anak</p>
        <p class="header-address">Alamat: Kampung Bawah Magek, Kecamatan Kamang Magek, Kabupaten Agam</p>
    </div>

    @foreach($periksaAnaks->groupBy(function($date) {
        return \Carbon\Carbon::parse($date->tanggal)->format('F Y');
    }) as $bulanTahun => $data)
        <h3>{{ $bulanTahun }}</h3>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Berat (kg)</th>
                    <th>Tinggi (cm)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $periksaAnak)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $periksaAnak->anak->nama_anak }}</td>
                        <td>{{ $periksaAnak->berat }}</td>
                        <td>{{ $periksaAnak->tinggi }}</td>
                    </tr>
                    <!-- Tambahkan informasi detail anak di bawah tabel -->
                    <tr>
                        <td colspan="4">
                            <div class="detail-info">
                                <p><strong>Nama Anak:</strong> {{ $periksaAnak->anak->nama_anak }}</p>
                                <p><strong>Nama Orang Tua:</strong> {{ $periksaAnak->anak->nama_ortu }}</p>
                                <p><strong>Tempat Lahir:</strong> {{ $periksaAnak->anak->tempat_lahir }}</p>
                                <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($periksaAnak->anak->tgl_lahir)->format('d F Y') }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $periksaAnak->anak->jenkel }}</p>
                                <p><strong>Anak-ke:</strong> {{ $periksaAnak->anak->anak_ke }}</p>
                                <p><strong>Umur:</strong> {{ $periksaAnak->anak->umur }} Tahun</p>
                            </div>
                        </td>
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

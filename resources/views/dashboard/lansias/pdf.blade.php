<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Lansia PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div class="header">
        <h1>Posyandu Sarana Sehat</h1>
        <p class="header-caption">Laporan Pemeriksaan Lansia</p>
        <p class="header-address">Alamat: Kampung Bawah Magek, Kecamatan Kamang Magek, Kabupaten Agam</p>
    </div>

    <div class="detail-info">
        <p><strong>Nama Lansia:</strong> {{ $lansia->nama_lansia }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($lansia->tgl_lahir)->format('d F Y') }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $lansia->jenis_kelamin }}</p>
        <p><strong>Umur:</strong> {{ $lansia->umur }} Tahun</p>
    </div>

    <!-- Tabel Pemeriksaan -->
    <div class="section-title">Pemeriksaan</div>
    @if($lansia->periksaLansias->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Berat (kg)</th>
                    <th>Tekanan Darah</th>
                    <th>Lingkar Perut</th>
                </tr>
            </thead>          
            <tbody>
                @foreach($lansia->periksaLansias as $periksaLansia)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($periksaLansia->tanggal)->format('d F Y') }}</td>
                        <td>{{ $periksaLansia->berat ?? 'Tidak ada' }}</td>
                        <td>{{ $periksaLansia->tekanan_darah ?? 'Tidak ada' }}</td>
                        <td>{{ $periksaLansia->lingkar_perut ?? 'Tidak ada' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data pemeriksaan.</p>
    @endif
    <div class="footer">
        <p>&copy; Posyandu Sarana Sehat</p>
    </div>
</body>
</html>

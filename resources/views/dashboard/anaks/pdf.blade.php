<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anak PDF</title>
    <link rel="stylesheet" href="{{ public_path('css/pdf.css') }}">
</head>
<body>
    <div class="header">
        <h1>Posyandu Sarana Sehat</h1>
        <p class="header-caption">Laporan Pemeriksaan Anak</p>
        <p class="header-address">Alamat: Kampung Bawah Magek, Kecamatan Kamang Magek, Kabupaten Agam</p>
    </div>
    

    <div class="detail-info">
        <p><strong>Nama Anak:</strong> {{ $anak->nama_anak }}</p>
        <p><strong>Nama Orang Tua:</strong> {{ $anak->nama_ortu }}</p>
        <p><strong>Tempat Lahir:</strong> {{ $anak->tempat_lahir }}</p>
        <p><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($anak->tgl_lahir)->format('d F Y') }}</p>
        <p><strong>Jenis Kelamin:</strong> {{ $anak->jenis_kelamin }}</p>
        <p><strong>Anak-ke:</strong> {{ $anak->anak_ke }}</p>
        <p><strong>Umur:</strong> {{ $anak->umur }} Tahun</p>
    </div>

    <!-- Tabel Pemeriksaan -->
    <div class="section-title">Pemeriksaan</div>
    @if($anak->periksas->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Berat (kg)</th>
                    <th>Tinggi (cm)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anak->periksas as $periksa)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($periksa->tanggal)->format('d F Y') }}</td>
                        <td>{{ $periksa->berat ?? 'Tidak ada' }}</td>
                        <td>{{ $periksa->tinggi ?? 'Tidak ada' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data pemeriksaan.</p>
    @endif

    <!-- Tabel Imunisasi -->
    <div class="section-title">Imunisasi</div>
    @if($anak->imunisasis->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis Imunisasi</th>
                    <th>Booster</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anak->imunisasis as $imunisasi)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($imunisasi->tanggal)->format('d F Y') }}</td>
                        <td>{{ optional($imunisasi->jenisImunisasi)->nama_imun ?? 'Tidak diketahui' }}</td>
                        <td>{{ $imunisasi->booster ?? 'Tidak ada' }}</td>
                        <td>{{ $imunisasi->ket_imun ?? 'Tidak ada keterangan' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data imunisasi.</p>
    @endif

    <!-- Tabel Vitamin A -->
    <div class="section-title">Vitamin A</div>
    @if($anak->vitaminAs->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anak->vitaminAs as $vitaminA)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($vitaminA->tanggal)->format('d F Y') }}</td>
                        <td>{{ $vitaminA->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data vitamin A.</p>
    @endif

    <!-- Tabel Obat Cacing -->
    <div class="section-title">Obat Cacing</div>
    @if($anak->obatCacings->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($anak->obatCacings as $obatCacing)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($obatCacing->tanggal)->format('d F Y') }}</td>
                        <td>{{ $obatCacing->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Tidak ada data obat cacing.</p>
    @endif

    <div class="footer">
        <p>&copy; Posyandu Sarana Sehat</p>
    </div>
</body>
</html>

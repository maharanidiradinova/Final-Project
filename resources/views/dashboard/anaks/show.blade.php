@extends('dashboard.layouts.main')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
@endpush

@section('container')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Detail Anak</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('anaks.index') }}">Data Anak</a></li>
                    <li class="breadcrumb-item active">Detail Anak</li>
                </ol>
                
            </div>
        </div>
        <a href="{{ route('anaks.generatePDF', $anak->id) }}" class="btn btn-primary mb-3">
            <i class="fas fa-file-pdf"></i> Cetak PDF
        </a>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Detail Anak -->
                        <h2>{{ $anak->nama_anak }}</h2>
                        <dl class="row">
                            <dt class="col-sm-3">Nama Orang Tua</dt>
                            <dd class="col-sm-9">{{ $anak->nama_ortu }}</dd>

                            <dt class="col-sm-3">Tempat Lahir</dt>
                            <dd class="col-sm-9">{{ $anak->tempat_lahir }}</dd>

                            <dt class="col-sm-3">Tanggal Lahir</dt>
                            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($anak->tgl_lahir)->format('d F Y') }}</dd>

                            <dt class="col-sm-3">Jenis Kelamin</dt>
                            <dd class="col-sm-9">{{ $anak->jenis_kelamin }}</dd>

                            <dt class="col-sm-3">Anak-ke</dt>
                            <dd class="col-sm-9">{{ $anak->anak_ke }}</dd>

                            <dt class="col-sm-3">Umur</dt>
                            <dd class="col-sm-9">{{ $anak->umur }} Tahun</dd>
                        </dl>

                        <!-- Tabel Imunisasi -->
                        <h3>Pemeriksaan</h3>
                        @if($periksas->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Berat (kg)</th>
                                        <th>Tinggi (cm)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periksas as $periksa)
                                        <tr>
                                            <td>{{ $periksa->tanggal->format('d F Y') }}</td>
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
                        <h3>Imunisasi</h3>
                        @if($imunisasis->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Jenis Imunisasi</th>
                                        <th>Booster</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($imunisasis as $imunisasi)
                                        <tr>
                                            <td>{{ $imunisasi->tanggal->format('d F Y') }}</td>
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
                        <h3>Vitamin A</h3>
                        @if($vitaminAs->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($vitaminAs as $vitaminA)
                                        <tr>
                                            <td>{{ $vitaminA->tanggal->format('d F Y') }}</td>
                                            <td>{{ $vitaminA->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data vitamin A.</p>
                        @endif

                        <!-- Tabel Obat Cacing -->
                        <h3>Obat Cacing</h3>
                        @if($obatCacings->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($obatCacings as $obatCacing)
                                        <tr>
                                            <td>{{ $obatCacing->tanggal->format('d F Y') }}</td>
                                            <td>{{ $obatCacing->keterangan }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Tidak ada data obat cacing.</p>
                        @endif
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

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
                <h1>Detail Lansia</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('lansias.index') }}">Data Lansia</a></li>
                    <li class="breadcrumb-item active">Detail Lansia</li>
                </ol>
            </div>
        </div>
        <a href="{{ route('lansias.generatePDF', $lansia->id) }}" class="btn btn-primary mb-3">
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
                        <!-- Detail Lansia -->
                        <h2>{{ $lansia->nama_lansia }}</h2>
                        <dl class="row">
                            
                            <dt class="col-sm-3">Tanggal Lahir</dt>
                            <dd class="col-sm-9">{{ \Carbon\Carbon::parse($lansia->tgl_lahir)->format('d F Y') }}</dd>

                            <dt class="col-sm-3">Jenis Kelamin</dt>
                            <dd class="col-sm-9">{{ $lansia->jenis_kelamin }}</dd>

                            <dt class="col-sm-3">Umur</dt>
                            <dd class="col-sm-9">{{ $lansia->umur }}</dd>
                        </dl>

                        <!-- Tabel Pemeriksaan -->
                        <h3>Pemeriksaan</h3>
                        @if($periksaLansias->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Berat (kg)</th>
                                        <th>Tekanan Darah</th>
                                        <th>Lingkar Perut (cm)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periksaLansias as $periksaLansia)
                                        <tr>
                                            <td>{{ $periksaLansia->tanggal->format('d F Y') }}</td>
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
                        
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

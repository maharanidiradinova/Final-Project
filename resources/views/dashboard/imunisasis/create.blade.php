@extends('dashboard.layouts.main')

@section('container')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Tambah Data Imunisasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/imunisasis">Imunisasi</a></li>
                    <li class="breadcrumb-item active">Tambah Imunisasi</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Imunisasi Anak</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('imunisasis.store') }}" class="mb-5">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <!-- Tanggal Pemeriksaan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal Pemeriksaan</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                                        @error('tanggal')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilih Anak -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="anak_id">Nama Anak</label>
                                        <select class="form-control @error('anak_id') is-invalid @enderror" name="anak_id" id="anak_id">
                                            <option value="" disabled selected>-- Pilih Nama Anak --</option>
                                            @foreach ($anaks as $anak)
                                                <option value="{{ $anak->id }}" {{ old('anak_id') == $anak->id ? 'selected' : '' }}>{{ $anak->nama_anak }}</option>
                                            @endforeach
                                        </select>
                                        @error('anak_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilih Jenis Imunisasi -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_imunisasis_id">Jenis Imunisasi</label>
                                        <select class="form-control @error('jenis_imunisasis_id') is-invalid @enderror" name="jenis_imunisasis_id" id="jenis_imunisasis_id">
                                            <option value="" disabled selected>-- Pilih Jenis Imunisasi --</option>
                                            @foreach ($jenis_imunisasis as $jenisImunisasi)
                                                <option value="{{ $jenisImunisasi->id }}" {{ old('jenis_imunisasis_id') == $jenisImunisasi->id ? 'selected' : '' }}>{{ $jenisImunisasi->nama_imun }}</option>
                                            @endforeach
                                        </select>
                                        @error('jenis_imunisasis_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pilih Booster -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="booster">Booster</label>
                                        <select class="form-control @error('booster') is-invalid @enderror" name="booster" id="booster">
                                            <option value="" disabled selected>-- Pilih Booster --</option>
                                            <option value="Ya" {{ old('booster') == 'Ya' ? 'selected' : '' }}>Ya</option>
                                            <option value="Tidak" {{ old('booster') == 'Tidak' ? 'selected' : '' }}>Tidak</option>
                                        </select>
                                        @error('booster')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ket_imun">Keterangan</label>
                                        <input type="text" class="form-control @error('ket_imun') is-invalid @enderror" id="ket_imun" name="ket_imun" value="{{ old('ket_imun') }}">
                                        @error('ket_imun')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" onclick="window.history.back();">Kembali</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection

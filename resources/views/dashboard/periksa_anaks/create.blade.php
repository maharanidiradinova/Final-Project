@extends('dashboard.layouts.main')

@section('container')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pemeriksaan Anak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/periksa_anaks">Pemeriksaan Anak</a></li>
            <li class="breadcrumb-item active">Tambah Pemeriksaan</li>
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
              <h3 class="card-title">Tambah Pemeriksaan Anak</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('periksa_anaks.store') }}" class="mb-5">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <label for="tanggal">Tanggal Pemeriksaan</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal') }}" required>
                      @error('tanggal')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="anak_id">Nama Anak</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select class="form-control @error('anak_id') is-invalid @enderror" id="anak_id" name="anak_id" required>
                        <option value="" disabled selected>-- Pilih Nama Anak --</option>
                        @foreach($anaks as $anak)
                          <option value="{{ $anak->id }}">{{ $anak->nama_anak }}</option>
                        @endforeach
                      </select>
                      @error('anak_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="berat">Berat (kg)</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-weight-scale"></i></span>
                      </div>
                      <input type="text" class="form-control @error('berat') is-invalid @enderror" id="berat" name="berat" value="{{ old('berat') }}" required>
                      @error('berat')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="tinggi">Tinggi (cm)</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa-solid fa-ruler"></i></span>
                      </div>
                      <input type="text" class="form-control @error('tinggi') is-invalid @enderror" id="tinggi" name="tinggi" value="{{ old('tinggi') }}" required>
                      @error('tinggi')
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
                <a href="{{ route('periksa_anaks.index') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
@endsection

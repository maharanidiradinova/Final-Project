@extends('dashboard.layouts.main')

@section('container')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Pemeriksaan Lansia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/periksa_lansias">Periksa Lansia</a></li>
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
              <h3 class="card-title">Tambah Pemeriksaan Lansia</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('periksa_lansias.store') }}" class="mb-5">
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
                    <label for="lansia_id">Nama Lansia</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select class="form-control @error('lansia_id') is-invalid @enderror" id="lansia_id" name="lansia_id" required>
                        <option value="" disabled selected>-- Pilih Nama Lansia --</option>
                        @foreach($lansias as $a) <!-- Gunakan $lansias di sini -->
                          <option value="{{ $a->id }}">{{ $a->nama_lansia }}</option>
                        @endforeach
                      </select>
                      @error('lansia_id')
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
                        <span class="input-group-text"><i class="fas fa-weight"></i></span>
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
                    <label for="berat">Tekanan Darah</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                      </div>
                      <input type="text" class="form-control @error('tekanan_darah') is-invalid @enderror" id="tekanan_darah" name="tekanan_darah" value="{{ old('tekanan_darah') }}" required>
                      @error('tekanan_darah')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="col-md-6">
                    <label for="lingkar_perut">Lingkar Perut (cm)</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-ruler-vertical"></i></span>
                      </div>
                      <input type="text" class="form-control @error('lingkar_perut') is-invalid @enderror" id="lingkar_perut" name="lingkar_perut" value="{{ old('lingkar_perut') }}" required>
                      @error('lingkar_perut')
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
                <a href="{{ route('periksa_lansias.index') }}" class="btn btn-secondary">Kembali</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
@endsection

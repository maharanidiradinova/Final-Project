@extends('dashboard.layouts.main')

@section('container')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Data Lansia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/lansias">Lansia</a></li>
            <li class="breadcrumb-item active">Edit Data Lansia</li>
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
              <h3 class="card-title">Edit Lansia</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="{{ route('lansias.update', $lansia->id) }}" class="mb-5" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="scrollable-form">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="nama_lansia">Nama Lansia</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-venus"></i></span>
                                </div>
                                <input type="text" class="form-control @error('nama_lansia') is-invalid @enderror" id="nama_lansia" name="nama_lansia" value="{{ old('nama_lansia', $lansia->nama_lansia) }}" autofocus>
                                @error('nama_lansia')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                </div>
                                <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', $lansia->tgl_lahir->format('Y-m-d')) }}">
                                @error('tgl_lahir')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                              </div>
                              <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                                <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki - Laki" {{ old('jenis_kelamin', $lansia->jenis_kelamin) == 'Laki - Laki' ? ' selected' : '' }}>Laki - Laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', $lansia->jenis_kelamin) == 'Perempuan' ? ' selected' : '' }}>Perempuan</option>
                              </select>
                              @error('jenis_kelamin')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                              @enderror
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('lansias.index') }}" class="btn btn-secondary">Batal</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection

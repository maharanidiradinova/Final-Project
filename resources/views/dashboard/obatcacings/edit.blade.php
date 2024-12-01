@extends('dashboard.layouts.main')

@section('container')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Data Obat Cacing</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/obatcacings">Obat Cacing</a></li>
            <li class="breadcrumb-item active">Edit Obat Cacing</li>
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
              <h3 class="card-title">Edit Data Obat Cacing</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('obatcacings.update', $obatcacing->id) }}" class="mb-5">
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="row">
                  <label for="tanggal">Tanggal</label>
                  <div class="input-group mb-3">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-calendar"></i></span>
                      </div>
                      <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $obatcacing->tanggal ? $obatcacing->tanggal->format('Y-m-d') : '') }}">
                      @error('tanggal')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                      @enderror
                  </div>

                  <div class="col-md-6">
                    <label for="anak_id">Nama Anak</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                      <select class="form-control @error('anak_id') is-invalid @enderror" id="anak_id" name="anak_id" required>
                        <option value="" disabled>Pilih Nama Anak</option>
                        @foreach($anaks as $a)
                          <option value="{{ $a->id }}" {{ $a->id == old('anak_id', $obatcacing->anak_id) ? 'selected' : '' }}>
                            {{ $a->nama_anak }}
                          </option>
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
                    <label for="keterangan">Keterangan</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-clipboard"></i></span>
                      </div>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $obatcacing->keterangan) }}">
                      @error('keterangan')
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
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('obatcacings.index') }}" class="btn btn-secondary">Batal</a>
            </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection

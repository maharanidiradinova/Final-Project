@extends('dashboard.layouts.main')

@section('container')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Pemeriksaan Lansia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/periksa_lansias">Pemeriksaan Lansia</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <!-- Flex container for the search form and create button -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Form pencarian -->
                <form method="GET" action="{{ route('periksa_lansias.index') }}" class="d-flex flex-grow-1">
                  <input type="text" name="search" class="form-control me-2" placeholder="Nama Lansia" value="{{ request()->input('search') }}" style="max-width: 300px;">
                  <input type="month" name="bulan_awal" class="form-control me-2" value="{{ request()->input('bulan_awal') }}" style="max-width: 200px;" placeholder="Bulan Awal">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <!-- Create button -->
                <div class="d-flex align-items-center">
                  <a href="{{ route('periksa_lansias.pdf', ['bulan_awal' => request()->input('bulan_awal')]) }}" class="btn btn-secondary btn-sm rounded me-3">
                      <i class="fas fa-file-pdf"></i> PDF
                  </a>
                  <a href="{{ route('periksa_lansias.create') }}" class="btn btn-primary btn-sm rounded">
                      Create
                  </a>
              </div>
              
              
              </div>
              <!-- Tabel data -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Lansia</th>
                    <th>Berat (kg)</th>
                    <th>Tekanan Darah</th>
                    <th>Lingkar Perut (cm)</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($periksaLansias as $key => $periksaLansia)
                    <tr>
                      <td>{{ $periksaLansias->firstItem() + $key }}</td>
                      <td>{{ \Carbon\Carbon::parse($periksaLansia->tanggal)->format('d-m-Y') }}</td>
                      <td>{{ $periksaLansia->lansia->nama_lansia }}</td>
                      <td>{{ $periksaLansia->berat }}</td>
                      <td>{{ $periksaLansia->tekanan_darah }}</td>
                      <td>{{ $periksaLansia->lingkar_perut }}</td>
                      <td>
                        <a href="{{ route('periksa_lansias.edit', $periksaLansia->id) }}" class="btn btn-success btn-sm">
                          <i class="far fa-edit action-icon"></i>
                        </a>
                        <form action="{{ route('periksa_lansias.destroy', $periksaLansia->id) }}" method="POST" class="d-inline">
                          @method('DELETE')
                          @csrf
                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Kamu Yakin?')">
                            <i class="far fa-trash-alt action-icon"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $periksaLansias->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection

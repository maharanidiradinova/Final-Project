@extends('dashboard.layouts.main')

@section('container')

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Daftar Pemeriksaan Anak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="/dashboard/periksa_anaks">Pemeriksaan Anak</a></li>
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
                <form method="GET" action="{{ route('periksa_anaks.index') }}" class="d-flex flex-grow-1">
                  <input type="text" name="search" class="form-control me-2" placeholder="Nama Anak" value="{{ request()->input('search') }}" style="max-width: 300px;">
                  <input type="month" name="bulan_awal" class="form-control me-2" value="{{ request()->input('bulan_awal') }}" style="max-width: 200px;" placeholder="Bulan Awal">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <!-- Create button -->
                 <a href="{{ route('periksa_anaks.pdf', ['bulan_awal' => request()->input('bulan_awal')]) }}" class="btn btn-secondary btn-sm ms-3">
                    <i class="fas fa-file-pdf"></i>PDF
                </a>
                <a href="{{ route('periksa_anaks.create') }}" class="btn btn-primary btn-sm ms-3">Create</a>
                
                
              </div>
              <!-- Tabel data -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Anak</th>
                    <th>Berat (kg)</th>
                    <th>Tinggi (cm)</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($periksaAnaks as $key => $periksaAnak)
                    <tr>
                      <td>{{ $periksaAnaks->firstItem() + $key }}</td>
                      <td>{{ \Carbon\Carbon::parse($periksaAnak->tanggal)->format('d-m-Y') }}</td>
                      <td>{{ $periksaAnak->anak->nama_anak }}</td>
                      <td>{{ $periksaAnak->berat }}</td>
                      <td>{{ $periksaAnak->tinggi }}</td>
                      <td>
                        <a href="{{ route('periksa_anaks.edit', $periksaAnak->id) }}" class="btn btn-success btn-sm">
                          <i class="far fa-edit action-icon"></i>
                        </a>
                        <form action="{{ route('periksa_anaks.destroy', $periksaAnak->id) }}" method="POST" class="d-inline">
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
              {{ $periksaAnaks->links() }}
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>

@endsection

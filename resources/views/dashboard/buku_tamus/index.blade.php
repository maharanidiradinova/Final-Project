@extends('dashboard.layouts.main')

@section('container')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Laporan Data Tamu</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
          <li class="breadcrumb-item"><a href="/dashboard/buku_tamus">Tamu</a></li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

@if(session()->has('success'))
<div class="container-fluid">
  <div class="alert alert-success col-lg-12" role="alert">
    {{ session('success') }}
  </div>
</div>
@endif

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
           
            <div class="d-flex justify-content-between align-items-center mb-3">
              
              @can('admin')
              <a href="{{ route('periksa_anaks.create') }}" class="btn btn-primary btn-sm ms-3">Create</a>
              @endcan

              <!-- Form pencarian -->
              <form method="GET" action="{{ route('buku_tamus.index') }}" class="d-flex flex-grow-1">
                <input type="text" name="search" class="form-control me-2" placeholder="Nama Tamu" value="{{ request()->input('search') }}" style="max-width: 300px;">
                <input type="text" name="alamat" class="form-control me-2" placeholder="Alamat" value="{{ request()->input('alamat') }}" style="max-width: 300px;">
                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
              </form>
            </div>

            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Tamu</th>
                  <th>Alamat</th>
                  <th>Jabatan</th>
                  <th>Keperluan</th>
                  @can ('admin')
                  <th>Action</th>
                  @endcan
                </tr>
              </thead>
              <tbody>
                @foreach ($buku_tamus as $tamu)    
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $tamu->nama_tamu }}</td>
                  <td>{{ $tamu->alamat }}</td>
                  <td>{{ $tamu->jabatan }}</td>
                  <td>{{ $tamu->keperluan }}</td>
                  @can ('admin')
                  <td>
                    <a href="/dashboard/buku_tamus/{{ $tamu->id }}/edit" class="btn btn-success"><i class="far fa-edit"></i></a>
                    <form action="/dashboard/buku_tamus/{{ $tamu->id }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger border-0" onclick="return confirm('Kamu Yakin?')"><i class="far fa-trash-alt"></i></button>
                    </form>
                  </td>
                  @endcan
                </tr>
                @endforeach
              </tbody>
            </table>
            {{ $buku_tamus->links() }} 
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

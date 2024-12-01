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
          <h1>Data Anak</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Anak</li>
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
            <!-- /.card-header -->
            <div class="card-body">
              <!-- Flex container for search and create button -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Button Create -->
                @can('create', App\Models\Anak::class)
                <a href="{{ route('anaks.create') }}" class="btn btn-primary">
                  <i class="fas fa-plus-square"></i> Create
                </a>
                @endcan
                <!-- Form search -->
                <form method="GET" action="{{ route('anaks.index') }}" class="d-flex">
                  <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->input('search') }}" style="max-width: 300px;">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
              </div>
            </div>
              <div class="table-container">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Anak</th>
                    <th>Nama Orang Tua</th>
                    <th>Tempat Lahir</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Anak-ke</th>
                    <th>Umur</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($anaks as $index => $anak)
                  <tr>
                    <td>{{ $anaks->firstItem() + $index }}</td>
                    <td>{{ $anak->nama_anak }}</td>
                    <td>{{ $anak->nama_ortu }}</td>
                    <td>{{ $anak->tempat_lahir }}</td>
                    <td>{{ $anak->tgl_lahir->isoFormat('dddd, D MMMM Y') }}</td>
                    <td>{{ $anak->jenis_kelamin }}</td>
                    <td>{{ $anak->anak_ke }}</td>
                    <td>{{ $anak->umur }} Tahun</td>
                    <td>
                      <!-- Show 'More' button for all users -->
                      <a href="{{ route('anaks.show', $anak->id) }}" class="btn btn-primary btn-sm">
                          <i class="fas fa-info-circle"></i>
                      </a>
                  
                      <!-- Conditional buttons based on user role -->
                      @can('update', $anak)
                          <!-- Admin and Super Admin can see 'Edit' button -->
                          <a href="{{ route('anaks.edit', $anak->id) }}" class="btn btn-success btn-sm">
                              <i class="far fa-edit action-icon"></i> 
                          </a>
                      @endcan
                  
                      @can('delete', $anak)
                          <!-- Super Admin can see 'Delete' button -->
                          <form action="{{ route('anaks.destroy', $anak->id) }}" method="post" class="d-inline">
                              @method('delete')
                              @csrf
                              <button class="btn btn-danger border-0 btn-sm" onclick="return confirm('Yakin akan menghapus data?')">
                                  <i class="far fa-trash-alt action-icon"></i>
                              </button>
                          </form>
                      @endcan
                  </td>
                             
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                {{ $anaks->links() }}
              </div>
            </div>
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

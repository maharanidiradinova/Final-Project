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
          <h1>Data Lansia</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            <li class="breadcrumb-item active">Lansia</li>
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
              <!-- Flex container for search and create button -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <!-- Button Create -->
                @can('create', App\Models\Lansia::class)
                <a href="{{ route('lansias.create') }}" class="btn btn-primary">
                  <i class="fas fa-plus-square"></i> Create
                </a>
                @endcan
                <!-- Form search -->
                <form method="GET" action="{{ route('lansias.index') }}" class="d-flex">
                  <input type="text" name="search" class="form-control me-2" placeholder="Search" value="{{ request()->input('search') }}" style="max-width: 300px;">
                  <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                </form>
              </div>
              <div class="table-container">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Lansia</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>Umur</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($lansias as $index => $lansia)
                    <tr>
                      <td>{{ $lansias->firstItem() + $index }}</td>
                      <td>{{ $lansia->nama_lansia }}</td>
                      <td>{{ \Carbon\Carbon::parse($lansia->tgl_lahir)->isoFormat('dddd, D MMMM YYYY') }}</td>
                      <td>{{ $lansia->jenis_kelamin }}</td>
                      <td>{{ $lansia->umur }}</td>
                      <td>
                       <!-- Show 'More' button for all users -->
                       <a href="{{ route('lansias.show', $lansia->id) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-info-circle"></i>
                      </a>
                      <!-- Conditional buttons based on user role -->
                      @if(auth()->user()->isAdmin())
                        <!-- Admin can see 'Edit' button -->
                        <a href="{{ route('lansias.edit', $lansia->id) }}" class="btn btn-success btn-sm">
                          <i class="far fa-edit action-icon"></i> 
                        </a>
                      @else
                        <!-- super_admin can see 'Delete' button -->
                        <form action="{{ route('lansias.destroy', $lansia->id) }}" method="post" class="d-inline">
                          @method('delete')
                          @csrf
                          <button class="btn btn-danger border-0 btn-sm" onclick="return confirm('Yakin akan menghapus data?')">
                            <i class="far fa-trash-alt action-icon"></i>
                          </button>
                        </form>
                      @endif
                
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                {{ $lansias->links() }}
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
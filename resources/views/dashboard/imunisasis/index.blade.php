@extends('dashboard.layouts.main')

@section('container')

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Imunisasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><a href="/dashboard/imunisasis">Imunisasi</a></li>
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
                            <form method="GET" action="{{ route('imunisasis.index') }}" class="d-flex flex-grow-1">
                                <input type="text" name="search" class="form-control me-2" placeholder="Nama Anak" value="{{ request()->input('search') }}" style="max-width: 300px;">
                                <input type="number" name="bulan" class="form-control me-2" placeholder="Bulan" min="1" max="12" value="{{ request()->input('bulan') }}" style="max-width: 100px;">
                                <input type="number" name="tahun" class="form-control me-2" placeholder="Tahun" min="2020" value="{{ request()->input('tahun') }}" style="max-width: 100px;">
                                <button class="btn btn-primary btn-sm" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                            <!-- Create button -->
                            <a href="{{ route('imunisasis.create') }}" class="btn btn-primary btn-sm ms-3">Create</a>
                        </div>
                        <!-- Tabel data -->
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anak</th>
                                    <th>Jenis Imunisasi</th>
                                    <th>Tanggal</th>
                                    <th>Booster</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($imunisasis as $key => $item)
                                    <tr>
                                        <td>{{ $imunisasis->firstItem() + $key }}</td>
                                        <td>{{ $item->anak->nama_anak }}</td>
                                        <td>{{ $item->jenisImunisasi->nama_imun }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}</td>
                                        <td>{{ $item->booster }}</td>
                                        <td>{{ $item->ket_imun }}</td>
                                        <td>
                                            <a href="{{ route('imunisasis.edit', $item->id) }}" class="btn btn-success"><i class="far fa-edit"></i></a>
                                            <form action="{{ route('imunisasis.destroy', $item->id) }}" method="post" class="d-inline">
                                                @method('delete')
                                                @csrf
                                                <button class="btn btn-danger border-0" onclick="return confirm('Kamu Yakin?')"><i class="far fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $imunisasis->links() }} 
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>

@endsection

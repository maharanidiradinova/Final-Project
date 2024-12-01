@extends('dashboard.layouts.main')

@section('container')
    <h1>Daftar Pengguna yang Belum Diverifikasi</h1>

    <!-- Tampilkan pesan sukses/error -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($unverifiedUsers->isEmpty())
        <p>Tidak ada pengguna yang belum diverifikasi.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($unverifiedUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Form untuk verifikasi -->
                            <form action="{{ route('admin.verify-user', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary">Verifikasi</button>
                            </form>                                                    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection

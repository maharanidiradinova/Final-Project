@extends('dashboard.layouts.main')

@section('container')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- Lansia -->
        <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-info-custom">
            <div class="inner">
              <h3>{{ $lansia }}</h3>
              <p>Lansia</p>
            </div>
            <div class="icon">
              <i class="fa fa-female"></i>
            </div>
            <a href="/dashboard/lansias" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- Anak -->
        <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-success-custom">
            <div class="inner">
              <h3>{{ $anak }}</h3>
              <p>Anak</p>
            </div>
            <div class="icon">
              <i class="fa fa-child"></i>
            </div>
            <a href="/dashboard/anaks" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <!-- Laporan -->
        @hasanyrole('admin|super_admin')
        <div class="col-lg-4 col-12">
          <!-- small box -->
          <div class="small-box bg-warning-custom">
            <div class="inner">
              <h3>{{ $bukuTamu }}</h3>
              <p>Tamu</p>
            </div>
            <div class="icon">
              <i class="fas fa-file-alt"></i>
            </div>
            <a href="/dashboard/buku_tamus" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        @endhasanyrole
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

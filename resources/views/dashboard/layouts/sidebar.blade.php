<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/dashboard" class="brand-link">
    <img src="/admin/img/logosip.jpg" alt="user" class="brand-image img-circle elevation-3">
    <span class="brand-text" style="font-size: 18px; color: #ffffff; font-weight: 300;">Posyandu Sarana Sehat</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="/admin/img/user.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        @if(auth()->check() && auth()->user()->hasRole('admin'))
          <a href="{{ route('admin.unverified-users') }}" class="nav-link">
            {{ auth()->user()->name }}
          </a>
        @else
          <span>{{ auth()->user()->name }}</span>
        @endif
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Menu visible to all users -->
        <li class="nav-item">
          <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Admin-specific menus -->
        @can('admin')
          <li class="nav-item">
            <a href="/dashboard/anaks" class="nav-link {{ Request::is('dashboard/anaks*') ? 'active' : '' }}">
              <i class="fa-solid fa-child"></i>
              <p>Data Anak</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/lansias" class="nav-link {{ Request::is('dashboard/lansias*') ? 'active' : '' }}">
              <i class="fa-solid fa-person"></i>
              <p>Data Lansia</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/periksa_anaks" class="nav-link {{ Request::is('dashboard/periksa_anaks*') ? 'active' : '' }}">
              <i class="fa-solid fa-scale-balanced"></i>
              <p>Pemeriksaan Anak</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/periksa_lansias" class="nav-link {{ Request::is('dashboard/periksa_lansias*') ? 'active' : '' }}">
              <i class="fas fa-heartbeat"></i>
              <p>Pemeriksaan Lansia</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/imunisasis" class="nav-link {{ Request::is('dashboard/imunisasis*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-syringe"></i>
              <p>Imunisasi</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/vitamins" class="nav-link {{ Request::is('dashboard/vitamin*') ? 'active' : '' }}">
              <i class="fas fa-pills"></i>
              <p>Vitamin A</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/dashboard/obatcacings" class="nav-link {{ Request::is('dashboard/obatcacings*') ? 'active' : '' }}">
              <i class="fa-solid fa-tablets"></i>
              <p>Obat Cacing</p>
            </a>
          </li>
          <li class="nav-item"> 
            <a href="/dashboard/buku_tamus" class="nav-link {{ Request::is('dashboard/buku_tamus*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-address-book"></i>
              <p>Data Tamu</p>
            </a>
          </li>
        @endcan

        <!-- Menus for admin and super_admin -->
        @hasanyrole('admin|super_admin')
        <li class="nav-item">
            <a href="/laporananak" class="nav-link {{ Request::is('laporananak*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i>
                <p>Laporan Pemeriksaan Anak</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/laporanlansia" class="nav-link {{ Request::is('laporanlansia*') ? 'active' : '' }}">
                <i class="fa-solid fa-file-pdf"></i>
                <p>Laporan Pemeriksaan Lansia</p>
            </a>
        </li>
        @endhasanyrole
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

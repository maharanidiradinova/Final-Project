<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    LoginController,
    RegisterController,
    DashboardController,
    DashboardAnakController,
    DashboardLansiaController,
    DashboardPeriksaAnakController,
    DashboardPeriksaLansiaController,
    DashboardImunisasiController,
    DashboardJenisImunisasiController,
    DashboardVitaminController,
    DashboardBukuTamuController,
    DashboardObatCacingController,
    LaporanPemeriksaanAnak,
    LaporanPemeriksaanLansia,
    AdminController,
};

// Public routes
Route::get('/', function () {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

Route::get('/about', function () {
    return view('about', [
        'title' => 'SIP | About',
        'active' => 'about'
    ]);
});

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'auth']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Resource routes for Dashboard
Route::resource('/dashboard/anaks', DashboardAnakController::class)->middleware('auth');
Route::resource('/dashboard/lansias', DashboardLansiaController::class)->middleware('auth');
Route::resource('/dashboard/periksa_anaks', DashboardPeriksaAnakController::class)->middleware('auth');
Route::resource('/dashboard/periksa_lansias', DashboardPeriksaLansiaController::class)->middleware('auth');
Route::resource('/dashboard/jenis_imunisasis', DashboardJenisImunisasiController::class)->middleware('auth');
Route::resource('/dashboard/imunisasis', DashboardImunisasiController::class)->middleware('auth');
Route::resource('/dashboard/vitamins', DashboardVitaminController::class)->middleware('auth');
Route::resource('/dashboard/obatcacings', DashboardObatCacingController::class)->middleware('auth');
Route::resource('/dashboard/buku_tamus', DashboardBukuTamuController::class)->middleware('auth');

Route::get('/dashboard/anaks/{id}/cetak-pdf', [DashboardAnakController::class, 'generatePDF'])->name('anaks.cetak_pdf');
Route::get('/dashboard/anaks/{id}/generate-pdf', [DashboardAnakController::class, 'generatePDF'])->name('anaks.generatePDF');
Route::get('/dashboard/lansias/{id}/cetak-pdf', [DashboardLansiaController::class, 'generatePDF'])->name('lansias.cetak_pdf');
Route::get('/dashboard/lansias/{id}/generate-pdf', [DashboardLansiaController::class, 'generatePDF'])->name('lansias.generatePDF');

Route::resource('/laporananak', LaporanPemeriksaanAnak::class)->middleware('auth');
Route::get('/periksa_anaks/pdf', [LaporanPemeriksaanAnak::class, 'exportPdf'])->name('periksa_anaks.pdf');
Route::resource('/laporanlansia', LaporanPemeriksaanLansia::class)->middleware('auth');
Route::get('/periksa_lansias/pdflansia', [LaporanPemeriksaanLansia::class, 'exportPdf'])->name('periksa_lansias.pdf');

// Route::resource('/laporanimunisasi', LaporanImunisasi::class)->middleware('auth');
// Route::get('/dashboard/imunisasis/pdfimunisasi', [LaporanImunisasiController::class, 'exportPdf'])->name('imunisasis.pdf');


// Admin routes
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/unverified-users', [AdminController::class, 'unverifiedUsers'])->name('admin.unverified-users');
    Route::post('/admin/verify-user/{id}', [AdminController::class, 'verifyUser'])->name('admin.verify-user');
});

// (Optional) Permission-based middleware
Route::middleware('can:manage-unverified-users')->group(function () {
    Route::get('/dashboard/unverified-users', [AdminController::class, 'unverifiedUsers'])->name('admin.unverified-users');
});


// Route::middleware(['role:admin|super_admin'])->group(function () {
//     Route::get('/laporananak', [LaporanPemeriksaanAnak::class, 'index'])->name('report.anak');
//     Route::get('/laporanlansia', [LaporanPemeriksaanLansia::class, 'indexlansia'])->name('report.lansia');
// });

Route::resource('/laporananak', LaporanPemeriksaanAnak::class)->middleware('auth');
Route::get('/periksa_anaks/pdf', [LaporanPemeriksaanAnak::class, 'exportPdf'])->name('periksa_anaks.pdf');
Route::resource('/laporanlansia', LaporanPemeriksaanLansia::class)->middleware('auth');
Route::get('/periksa_lansias/pdflansia', [LaporanPemeriksaanLansia::class, 'exportPdf'])->name('periksa_lansias.pdf');

// (Optional) Permission-based middleware - Hanya jika kamu ingin menggunakan permission khusus
Route::middleware('can:manage-unverified-users')->group(function () {
    Route::get('/dashboard/unverified-users', [AdminController::class, 'unverifiedUsers'])->name('admin.unverified-users');
});

// Route::middleware(['role:admin'])->group(function () {
//     Route::get('/dashboard/unverified-users', [AdminController::class, 'unverifiedUsers'])->name('admin.unverified-users');
// });

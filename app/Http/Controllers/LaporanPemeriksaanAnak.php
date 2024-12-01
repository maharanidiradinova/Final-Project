<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriksaAnak; // Sesuaikan dengan model Anda
use PDF; // Menggunakan library DomPDF untuk generate PDF
use Carbon\Carbon;

class LaporanPemeriksaanAnak extends Controller
{
    public function index(Request $request)
    {
        $query = PeriksaAnak::query();
        
        if ($request->filled('bulan_awal')) {
            $bulanAwal = $request->input('bulan_awal');
            $query->whereYear('tanggal', date('Y', strtotime($bulanAwal)))
                  ->whereMonth('tanggal', date('m', strtotime($bulanAwal)));
        }
        
        $periksaAnaks = $query->paginate(10);
        
        return view('laporan.index', compact('periksaAnaks'));
    }

    public function exportPdf(Request $request)
    {
        // Initialize query for PeriksaAnak model
        $query = PeriksaAnak::query();
    
        // Check if 'bulan_awal' is provided
        if ($request->filled('bulan_awal')) {
            $bulanAwal = $request->input('bulan_awal');
            
            // Convert 'bulan_awal' to year and month
            $year = date('Y', strtotime($bulanAwal));
            $month = date('m', strtotime($bulanAwal));
            
            // Filter records based on year and month
            $query->whereYear('tanggal', $year)
                  ->whereMonth('tanggal', $month);
        }
    
        // Get filtered records
        $periksaAnaks = $query->get();
        
        // Format 'bulan_awal' to a readable format for the PDF header
        $bulanTahun = $request->filled('bulan_awal') 
            ? \Carbon\Carbon::createFromFormat('Y-m', $bulanAwal)->format('F Y')
            : 'Semua Data';
    
        // Generate the PDF with view and variables
        $pdf = Pdf::loadView('laporan.pdf', compact('periksaAnaks', 'bulanTahun'));
    
        // Download the PDF
        return $pdf->download('laporan_pemeriksaan_anak.pdf');
    }
    
}

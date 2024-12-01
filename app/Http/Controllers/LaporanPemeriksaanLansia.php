<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriksaLansia; 
use PDF;
use Carbon\Carbon;

class LaporanPemeriksaanLansia extends Controller
{
    public function index(Request $request)
    {
        $query = PeriksaLansia::query();
        
        if ($request->filled('bulan_awal')) {
            $bulanAwal = $request->input('bulan_awal');
            $query->whereYear('tanggal', date('Y', strtotime($bulanAwal)))
                  ->whereMonth('tanggal', date('m', strtotime($bulanAwal)));
        }
        
        $periksaLansias = $query->paginate(10);
        
        return view('laporan.indexlansia', compact('periksaLansias'));
    }

    public function exportPdf(Request $request)
    {
        $query = PeriksaLansia::query();
    
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
        $periksaLansias = $query->get();
        
        // Format 'bulan_awal' to a readable format for the PDF header
        $bulanTahun = $request->filled('bulan_awal') 
            ? \Carbon\Carbon::createFromFormat('Y-m', $bulanAwal)->format('F Y')
            : 'Semua Data';
    
        // Generate the PDF with view and variables
        $pdf = Pdf::loadView('laporan.pdflansia', compact('periksaLansias', 'bulanTahun'));
    
        // Download the PDF
        return $pdf->download('laporan_bulanan_lansia.pdf');
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Models\PeriksaLansia;
use App\Models\Lansia;
use Illuminate\Http\Request;

class DashboardPeriksaLansiaController extends Controller
{
    public function index(Request $request)
{
    // Ambil parameter pencarian dari input request
    $search = $request->input('search');
    
    // Inisialisasi query untuk model PeriksaLansia
    $query = PeriksaLansia::query();
    
    // Tambahkan logika pencarian jika parameter 'search' diisi
    if ($search) {
        $query->whereHas('lansia', function ($q) use ($search) {
            $q->where('nama_lansia', 'like', "%{$search}%");
        });
    }

    // Cek apakah filter 'bulan_awal' diisi
    if ($request->filled('bulan_awal')) {
        $bulanAwal = $request->input('bulan_awal');
        $query->whereYear('tanggal', date('Y', strtotime($bulanAwal)))
              ->whereMonth('tanggal', date('m', strtotime($bulanAwal)));
    }

    // Dapatkan hasil query dengan pagination
    $periksaLansias = $query->paginate(10);

    // Return ke view dengan data yang telah difilter dan dipaginasi
    return view('dashboard.periksa_lansias.index', compact('periksaLansias'));
}

   
    public function create()
    {
        $lansias = Lansia::all();
        return view('dashboard.periksa_lansias.create', compact('lansias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'lansia_id' => 'required|exists:lansias,id',
            'berat' => 'required|numeric',
            'tekanan_darah' => 'required|string',
            'lingkar_perut' => 'required|numeric',
        ]);

        PeriksaLansia::create([
            'tanggal' => $request->tanggal,
            'lansia_id' => $request-> lansia_id,
            'berat' => $request->berat,
            'tekanan_darah' => $request->tekanan_darah,
            'lingkar_perut' => $request->lingkar_perut,
        ]);

        return redirect()->route('periksa_lansias.index')->with('success', 'Data peemriksaan berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $periksalansia = PeriksaLansia::findOrFail($id);
        $lansias = Lansia::all(); // Mendapatkan semua data lansia untuk dropdown

        return view('dashboard.periksa_lansias.edit', compact('periksalansia', 'lansias'));
    }



        public function update(Request $request, $id)
        {
            $request->validate([
                'tanggal' => 'required|date',
                'lansia_id' => 'required|exists:lansias,id',
                'berat' => 'required|numeric',
                'tekanan_darah' => 'required|string',
                'lingkar_perut' => 'required|numeric',
            ]);
            
            $periksaLansia = PeriksaLansia::findOrFail($id);
            $periksaLansia->update([
                'tanggal' => $request->tanggal,
                'lansia_id' => $request-> lansia_id,
                'berat' => $request->berat,
                'tekanan_darah' => $request->tekanan_darah,
                'lingkar_perut' => $request->lingkar_perut,
            ]);

            return redirect()->route('periksa_lansias.index')->with('succes', 'Data pemeriksaan berhasil diperbarui.');
        }

        public function destroy($id)
        {
            $periksaLansia = PeriksaLansia::findOrFail($id);
            $periksaLansia->delete();

            return redirect()->route('periksa_lansias.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
        }
}

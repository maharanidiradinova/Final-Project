<?php

namespace App\Http\Controllers;

use App\Models\PeriksaAnak;
use App\Models\Anak;
use Illuminate\Http\Request;

class DashboardPeriksaAnakController extends Controller
{
    public function index(Request $request)
{
    $query = PeriksaAnak::query();

    // Cek apakah filter 'bulan_awal' diisi
    if ($request->filled('bulan_awal')) {
        $bulanAwal = $request->input('bulan_awal');
        $query->whereYear('tanggal', date('Y', strtotime($bulanAwal)))
              ->whereMonth('tanggal', date('m', strtotime($bulanAwal)));
    }

    // Ambil parameter pencarian dari input request
    $search = $request->input('search');
    
    // Cek apakah ada input pencarian
    if ($search) {
        $query->whereHas('anak', function ($q) use ($search) {
            $q->where('nama_anak', 'like', "%{$search}%");
        });
    }

    // Gunakan pagination setelah semua filter diterapkan
    $periksaAnaks = $query->paginate(10);

    return view('dashboard.periksa_anaks.index', compact('periksaAnaks'));
}


    public function getAnaks(Request $request)
    {
        $search = $request->input('q');
        $anaks = Anak::where('nama_anak', 'LIKE', "%{$search}%")->get();
        return response()->json($anaks);
    }

    public function create()
    {
        $anaks = Anak::all();
        return view('dashboard.periksa_anaks.create', compact('anaks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anak_id' => 'required|exists:anaks,id',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);

        PeriksaAnak::create([
            'tanggal' => $request->tanggal,
            'anak_id' => $request->anak_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('periksa_anaks.index')->with('success', 'Data pemeriksaan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $periksaAnak = PeriksaAnak::findOrFail($id);
        $anaks = Anak::all();
        return view('dashboard.periksa_anaks.edit', [
            'periksaAnak' => $periksaAnak,
            'anaks' => $anaks
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'anak_id' => 'required|exists:anaks,id',
            'berat' => 'required|numeric',
            'tinggi' => 'required|numeric',
        ]);

        $periksaAnak = PeriksaAnak::findOrFail($id);
        $periksaAnak->update([
            'tanggal' => $request->tanggal,
            'anak_id' => $request->anak_id,
            'berat' => $request->berat,
            'tinggi' => $request->tinggi,
        ]);

        return redirect()->route('periksa_anaks.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $periksaAnak = PeriksaAnak::findOrFail($id);
        $periksaAnak->delete();

        return redirect()->route('periksa_anaks.index')->with('success', 'Data pemeriksaan berhasil dihapus.');
    }

}

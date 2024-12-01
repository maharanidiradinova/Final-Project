<?php

namespace App\Http\Controllers;

use App\Models\ObatCacing;
use App\Models\Anak;
use Illuminate\Http\Request;

class DashboardObatCacingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
        $query = ObatCacing::query();
    
        if ($search) {
            $query->whereHas('anak', function ($q) use ($search) {
                $q->where('nama_anak', 'like', "%{$search}%");
            });
        }
    
        if ($bulan && $tahun) {
            $query->whereMonth('tanggal', $bulan)
                  ->whereYear('tanggal', $tahun);
        } elseif ($bulan) {
            $query->whereMonth('tanggal', $bulan);
        } elseif ($tahun) {
            $query->whereYear('tanggal', $tahun);
        }
    
       
        $obatcacings = $query->paginate(10); 
    
        return view('dashboard.obatcacings.index', compact('obatcacings'));
    }

    public function create()
{
    $anaks = Anak::all(); 
    return view('dashboard.obatcacings.create', compact('anaks')); // Mengirim data anak ke view
}

    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'anak_id' => 'required|exists:anaks,id',
        'tanggal' => 'required|date',
        'keterangan' => 'required|string|max:255',
    ]);

    ObatCacing::create($validatedData);

    return redirect()->route('obatcacings.index')->with('success', 'Data Obatcacing A berhasil disimpan!');
}

    
    public function edit($id)
    {
        $obatcacing = Obatcacing::findOrFail($id);
        return view('dashboard.obatcacings.edit', [
            'obatcacing' => $obatcacing,
            'anaks' => Anak::all()
        ]);
    }
    
    public function update(Request $request, Obatcacing $obatcacing)
    {
        $validatedData = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);
    
        $obatcacing->update($validatedData);
    
        return redirect()->route('obatcacings.index')->with('success', 'Obatcacing updated successfully.');
    }
    
    public function destroy(Obatcacing $obatcacing)
    {
        $obatcacing->delete();
    
        return redirect()->route('dashboard.obatcacings.index')->with('success', 'Obatcacing has been deleted!');
    }
}    
<?php

namespace App\Http\Controllers;

use App\Models\Vitamin;
use App\Models\Anak;
use Illuminate\Http\Request;

class DashboardVitaminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
    
        $query = Vitamin::query();
    
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
    
       
        $vitamins = $query->paginate(10); 
    
        return view('dashboard.vitamins.index', compact('vitamins'));
    }

    public function create()
{
    $anaks = Anak::all(); 
    return view('dashboard.vitamins.create', compact('anaks')); // Mengirim data anak ke view
}

    
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'anak_id' => 'required|exists:anaks,id',
        'tanggal' => 'required|date',
        'keterangan' => 'required|string|max:255',
    ]);

    Vitamin::create($validatedData);

    return redirect()->route('vitamins.index')->with('success', 'Data Vitamin A berhasil disimpan!');
}

    
    public function edit($id)
    {
        $vitamin = Vitamin::findOrFail($id);
        return view('dashboard.vitamins.edit', [
            'vitamin' => $vitamin,
            'anaks' => Anak::all()
        ]);
    }
    
    public function update(Request $request, Vitamin $vitamin)
    {
        $validatedData = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'tanggal' => 'required|date',
            'keterangan' => 'required|string',
        ]);
    
        $vitamin->update($validatedData);
    
        return redirect()->route('vitamins.index')->with('success', 'Vitamin updated successfully.');
    }
    
    public function destroy(Vitamin $vitamin)
    {
        $vitamin->delete();
    
        return redirect()->route('dashboard.vitamins.index')->with('success', 'Vitamin has been deleted!');
    }
}    
<?php
namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Imunisasi;
use App\Models\JenisImunisasi;
use Illuminate\Http\Request;

class DashboardImunisasiController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    $query = Imunisasi::query();

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

   
    $imunisasis = $query->paginate(10); 

    return view('dashboard.imunisasis.index', compact('imunisasis'));
}


    public function create()
    {
        $jenis_imunisasis = JenisImunisasi::all();
        $anaks = Anak::all();
    
        return view('dashboard.imunisasis.create', compact('jenis_imunisasis', 'anaks'));
    }
    


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'anak_id' => 'required|exists:anaks,id',
            'jenis_imunisasis_id' => 'required|exists:jenis_imunisasis,id',
            'tanggal' => 'required|date',
            'booster' => 'nullable|string',
            'ket_imun' => 'nullable|string',
        ]);

        Imunisasi::create($validatedData);

        return redirect()->route('imunisasis.index')->with('success', 'Data imunisasi berhasil ditambahkan.');
    }

    public function edit(Imunisasi $imunisasi)
    {
        return view('dashboard.imunisasis.edit', [
            'imunisasi' => $imunisasi,
            'anaks' => Anak::all(),
            'jenis_imunisasis' => JenisImunisasi::all() // Pastikan nama variabel ini sesuai
        ]);
    }
    


    public function update(Request $request, Imunisasi $imunisasi)
    {
        $rules = [
            'jenis_imunisasis_id' => 'required',
            'anak_id' => 'required',
            'booster' => 'nullable|string',
            'ket_imun' => 'nullable|string|max:255'
        ];
    
        $validatedData = $request->validate($rules);
    
        $imunisasi->update($validatedData);
    
        return redirect()->route('imunisasis.index')->with('success', 'Imunisasi Successfully Updated!');
    }
    

    public function destroy(Imunisasi $imunisasi)
    {
        $imunisasi->delete();

        return redirect()->route('imunisasis.index')->with('success', 'Imunisasi has been deleted!');
    }
}

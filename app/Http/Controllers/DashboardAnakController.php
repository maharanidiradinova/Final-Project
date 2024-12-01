<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardAnakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $anaks = Anak::where('nama_anak', 'like', "%{$search}%")
                      ->orWhere('nama_ortu', 'like', "%{$search}%")
                      ->orWhere('tempat_lahir', 'like', "%{$search}%")
                      ->orWhere('tgl_lahir', 'like', "%{$search}%")
                      ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                      ->orWhere('anak_ke', 'like', "%{$search}%")
                      ->paginate(10);

        return view('dashboard.anaks.index', [
            'anaks' => $anaks,
            'search' => $search
        ]);
    }

    public function create()
    {
        $this->authorize('create', Anak::class);
        return view('dashboard.anaks.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_anak' => 'required|max:255',
            'nama_ortu' => 'required|max:255',
            'tempat_lahir' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'anak_ke' => 'required|integer',
        ]);

        $validatedData['umur'] = Carbon::parse($validatedData['tgl_lahir'])->diffInYears(Carbon::now());

        Anak::create($validatedData);

        return redirect()->route('anaks.index')->with('success', 'Data anak berhasil ditambahkan.');
    }

    public function edit(Anak $anak)
    {
        $this->authorize('update', $anak);
        return view('dashboard.anaks.edit', compact('anak'));
    }

    public function update(Request $request, Anak $anak)
    {
        $this->authorize('update', $anak);

        $validatedData = $request->validate([
            'nama_anak' => 'required|string|max:255',
            'nama_ortu' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'anak_ke' => 'required|integer',
        ]);

        $validatedData['umur'] = Carbon::parse($validatedData['tgl_lahir'])->diffInYears(Carbon::now());

        $anak->update($validatedData);

        return redirect()->route('anaks.index')->with('success', 'Data anak berhasil diupdate');
    }

    public function destroy($id)
    {
        // hanya super_admin yang bisa menghapus data anak
        if (auth()->user()->level !== 'member') {
            return redirect('/dashboard')->with('error', 'Unauthorized access');
        }

        $anak = Anak::findOrFail($id);
        $anak->delete();

        return redirect('/dashboard/anaks')->with('success', 'Anak has been deleted!');
    }
    

    public function show($id)
    {
        $anak = Anak::with(['periksas', 'imunisasis', 'vitaminAs', 'obatCacings'])->findOrFail($id);
        $this->authorize('view', $anak);

        return view('dashboard.anaks.show', [
            'anak' => $anak,
            'periksas' => $anak->periksas,
            'imunisasis' => $anak->imunisasis,
            'vitaminAs' => $anak->vitaminAs,
            'obatCacings' => $anak->obatCacings
        ]);
    }

    public function generatePDF($id)
    {
        $anak = Anak::with(['periksas', 'imunisasis', 'vitaminAs', 'obatCacings'])->findOrFail($id);
        $pdf = PDF::loadView('dashboard.anaks.pdf', compact('anak'));

        return $pdf->download('Detail_Anak_'.$anak->nama_anak.'.pdf');
    }
}














// namespace App\Http\Controllers;

// use App\Models\Anak;
// use App\Models\PeriksaAnak;
// use Illuminate\Http\Request;
// use Carbon\Carbon;
// use Barryvdh\DomPDF\Facade\Pdf;


// class DashboardAnakController extends Controller
// {
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }

//     public function index(Request $request)
//     {
//         $search = $request->input('search');

//         $anaks = Anak::where('nama_anak', 'like', "%{$search}%")
//                       ->orWhere('nama_ortu', 'like', "%{$search}%")
//                       ->orWhere('tempat_lahir', 'like', "%{$search}%")
//                       ->orWhere('tgl_lahir', 'like', "%{$search}%")
//                       ->orWhere('jenis_kelamin', 'like', "%{$search}%")
//                       ->orWhere('anak_ke', 'like', "%{$search}%")
//                       ->paginate(10);

//         return view('dashboard.anaks.index', [
//             'anaks' => $anaks,
//             'search' => $search
//         ]);
//     }

//     public function create()
//     {
//         return view('dashboard.anaks.create');
//     }

//     public function store(Request $request)
//     {
//         $validatedData = $request->validate([
//             'nama_anak' => 'required|max:255',
//             'nama_ortu' => 'required|max:255',
//             'tempat_lahir' => 'required|max:255',
//             'tgl_lahir' => 'required|date',
//             'jenis_kelamin' => 'required',
//             'anak_ke' => 'required|integer',
//         ]);

//         $validatedData['umur'] = Carbon::parse($validatedData['tgl_lahir'])->diffInYears(Carbon::now());

//         Anak::create($validatedData);

//         return redirect()->route('anaks.index')->with('success', 'Data anak berhasil ditambahkan.');
//     }

//     public function edit(Anak $anak)
//     {
//         $this->authorize('update', $anak);
//         return view('dashboard.anaks.edit', compact('anak'));
//     }

//     public function update(Request $request, Anak $anak)
// {
//     $this->authorize('update', $anak);

//     $validatedData = $request->validate([
//         'nama_anak' => 'required|string|max:255',
//         'nama_ortu' => 'required|string|max:255',
//         'tempat_lahir' => 'required|string|max:255',
//         'tgl_lahir' => 'required|date',
//         'jenis_kelamin' => 'required|string',
//         'anak_ke' => 'required|integer',
//     ]);

//     $validatedData['umur'] = Carbon::parse($validatedData['tgl_lahir'])->diffInYears(Carbon::now());

//     $anak->update($validatedData);

//     return redirect()->route('anaks.index')->with('success', 'Data anak berhasil diupdate');
// }

// public function destroy($id)
// {
    
//     if (auth()->user()->level !== 'member') {
//         return redirect('/dashboard')->with('error', 'Unauthorized access');
//     }

//     $anak = Anak::findOrFail($id);
//     $anak->delete();

//     return redirect('/dashboard/anaks')->with('success', 'Anak has been deleted!');
// }

//     public function show($id)
// {
//     $anak = Anak::with(['periksas', 'imunisasis', 'vitaminAs', 'obatCacings'])->findOrFail($id);
    
//     // Pass all necessary data to the view
//     return view('dashboard.anaks.show', [
//         'anak' => $anak,
//         'periksas' => $anak->periksas,
//         'imunisasis' => $anak->imunisasis,
//         'vitaminAs' => $anak->vitaminAs,
//         'obatCacings' => $anak->obatCacings
//     ]);
// }

// public function generatePDF($id)
// {
//     $anak = Anak::with(['periksas', 'imunisasis', 'vitaminAs', 'obatCacings'])->findOrFail($id);
    
//     $pdf = PDF::loadView('dashboard.anaks.pdf', compact('anak'));

//     return $pdf->download('Detail_Anak_'.$anak->nama_anak.'.pdf');
// }



// } -->

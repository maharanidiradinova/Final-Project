<?php 

namespace App\Http\Controllers;

use App\Models\Lansia;
use App\Models\PeriksaLansia;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class DashboardLansiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $lansias = Lansia::where('nama_lansia', 'like', "%{$search}%")
                        ->orWhere('tgl_lahir', 'like', "%{$search}%")
                        ->orWhere('umur', 'like', "%{$search}%")
                        ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                        ->paginate(10); 

        return view('dashboard.lansias.index', [
            'lansias' => $lansias,
            'search' => $search
        ]);
    }

    public function create()
    {
        return view('dashboard.lansias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lansia' => 'required|max:255|unique:lansias',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ]);

  
        $tgl_lahir = Carbon::parse($request->input('tgl_lahir'));
        $umur = $this->calculateAge($tgl_lahir);

        Lansia::create($validatedData + ['umur' => $umur]);

        return redirect('/dashboard/lansias')->with('success', 'Lansia Successfully Added!');
    }

    public function edit(Lansia $lansia)
    {
        $lansia->tgl_lahir = Carbon::parse($lansia->tgl_lahir)->format('Y-m-d');
        return view('dashboard.lansias.edit', [
            'lansia' => $lansia
        ]);
    }

    public function update(Request $request, Lansia $lansia)
    {
        $rules = [
            'nama_lansia' => 'required|max:255',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
        ];

        if ($request->nama_lansia != $lansia->nama_lansia) {
            $rules['nama_lansia'] = 'required|max:255|unique:lansias';
        }

        $validatedData = $request->validate($rules);

        $umur = $this->calculateAge(Carbon::parse($request->input('tgl_lahir')));

        $lansia->update($validatedData + ['umur' => $umur]);

        return redirect('/dashboard/lansias')->with('success', 'Lansia Successfully Updated!');
    }

    public function destroy($id)
    {
        // hanya super_admin yang bisa menghapus data lansia
        if (auth()->user()->level !== 'member') {
            return redirect('/dashboard')->with('error', 'Unauthorized access');
        }

        $lansia = Lansia::findOrFail($id);
        $lansia->delete();

        return redirect('/dashboard/lansias')->with('success', 'Lansia has been deleted!');
    }

    protected function calculateAge(Carbon $date)
    {
        $now = Carbon::now();
        $ageYears = $date->diffInYears($now);

        return "{$ageYears} Tahun";
    }

    public function show($id)
    {
        $lansia = Lansia::findOrFail($id);
    
       
        $periksaLansias = $lansia->periksaLansias;
   
        return view('dashboard.lansias.show', compact('lansia', 'periksaLansias'));
    }

    public function generatePDF($id)
    {
        $lansia = Lansia::with('periksaLansias')->findOrFail($id);

        $pdf = PDF::loadView('dashboard.lansias.pdf', ['lansia' => $lansia]);

        return $pdf->download('Detail_Lansia_'.$lansia->nama_lansia.'.pdf');
    }



}

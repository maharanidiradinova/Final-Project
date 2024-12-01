<?php
namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class DashboardBukuTamuController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $alamat = $request->input('alamat');

        $query = BukuTamu::query();

        // Pencarian berdasarkan nama tamu
        if ($search) {
            $query->where('nama_tamu', 'like', "%{$search}%");
        }

        // Pencarian berdasarkan alamat tamu
        if ($alamat) {
            $query->where('alamat', 'like', "%{$alamat}%");
        }

        $buku_tamus = $query->paginate(10); // Menampilkan 10 data per halaman

        return view('dashboard.buku_tamus.index', compact('buku_tamus'));
    }

    public function create()
    {
        return view('dashboard.buku_tamus.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
        ]);

        BukuTamu::create($validatedData);

        return redirect()->route('buku_tamus.index')->with('success', 'Data Buku Tamu berhasil ditambahkan.');
    }

    public function edit(BukuTamu $buku_tamu)
    {
        return view('dashboard.buku_tamus.edit', [
            'buku_tamu' => $buku_tamu,
        ]);
    }


    public function update(Request $request, BukuTamu $buku_tamu)
    {
        $rules = [
            'nama_tamu' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'keperluan' => 'required|string|max:255',
        ];

        $validatedData = $request->validate($rules);

        $buku_tamu->update($validatedData);

        return redirect()->route('buku_tamus.index')->with('success', 'Data Buku Tamu berhasil diperbarui.');
    }

    public function destroy(BukuTamu $buku_tamu)
    {
        $buku_tamu->delete();

        return redirect()->route('buku_tamus.index')->with('success', 'Data Buku Tamu berhasil dihapus.');
    }
}

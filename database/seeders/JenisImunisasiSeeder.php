<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisImunisasi;

class JenisImunisasiSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Data yang ingin diisi ke dalam tabel jenis_imunisasis
        $jenisImunisasi = [
            'Hepatitis B',
            'BCG',
            'Polio',
            'DPT-HIB',
            'Campak',
        ];

        // Looping untuk menambahkan data ke dalam tabel
        foreach ($jenisImunisasi as $namaImun) {
            JenisImunisasi::create([
                'nama_imun' => $namaImun,
            ]);
        }
    }
}

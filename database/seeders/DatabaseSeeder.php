<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role; // Tambahkan ini
use Spatie\Permission\Models\Permission; // Tambahkan ini
use App\Models\JenisImunisasi;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Membuat role admin dan super_admin jika belum ada
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);

        // Membuat User admin dan super_admin
        $rani = User::updateOrCreate(
            ['username' => 'rani'],
            [
                'name' => 'rani',
                'level' => 'admin',
                'email' => 'rani@gmail.com',
                'is_verified' => 1,
                'is_admin' => true,
                'password' => bcrypt('12345')
            ]
        );

        $ketua = User::updateOrCreate(
            ['username' => 'ketua'],
            [
                'name' => 'ketua',
                'level' => 'super_admin',
                'email' => 'ketua@gmail.com',
                'password' => bcrypt('12345678')
            ]
        );

        // Assign role ke user
        $rani->assignRole('admin');
        $ketua->assignRole('super_admin');

        // Panggil seeder lainnya
        $this->call(JenisImunisasiSeeder::class);
    }
}

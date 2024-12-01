<?
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AnakSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            $tglLahir = $faker->date('Y-m-d', 'now');
            $umur = $this->calculateAge($tglLahir);

            DB::table('anaks')->insert([
                'nama_anak' => $faker->name(),
                'nama_ortu' => $faker->name(),
                'tempat_lahir' => $faker->city(),
                'tgl_lahir' => $tglLahir,
                'jenis_kelamin' => $faker->randomElement(['Laki - Laki', 'Perempuan']),
                'anak_ke' => $faker->numberBetween(1, 10),
                'umur' => $umur,
            ]);
        }
    }

    protected function calculateAge($dateOfBirth)
    {
        $dob = new \DateTime($dateOfBirth);
        $today = new \DateTime('today');
        $age = $today->diff($dob)->y;

        // Batasi umur maksimal 5 tahun
        return min($age, 5);
    }
}

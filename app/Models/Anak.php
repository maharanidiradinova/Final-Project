<?php
namespace App\Models;
use App\Models\PeriksaAnak;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Anak extends Model
{
    protected $fillable = [
        'nama_anak',
        'nama_ortu',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'anak_ke',
        'umur'
    ];

    protected $dates = [
        'tgl_lahir', // Menambahkan tgl_lahir ke dalam daftar atribut yang dianggap sebagai tanggal
    ];

    public function periksas()
    {
        return $this->hasMany(PeriksaAnak::class);
    }

    public function imunisasis()
    {
        return $this->hasMany(Imunisasi::class);
    }

    public function vitaminAs()
    {
        return $this->hasMany(Vitamin::class);
    }

    public function obatCacings()
    {
        return $this->hasMany(ObatCacing::class);
    }
}

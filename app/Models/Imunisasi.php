<?php
 namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Imunisasi extends Model
{
    use HasFactory;

    protected $fillable = ['anak_id', 'jenis_imunisasis_id', 'tanggal', 'booster', 'ket_imun'];

    protected $dates = ['tanggal']; 

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }

    public function jenisImunisasi()
    {
        return $this->belongsTo(JenisImunisasi::class, 'jenis_imunisasis_id');
    }
}

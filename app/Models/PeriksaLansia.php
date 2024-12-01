<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PeriksaLansia extends Model
{
    protected $table = 'periksa_lansias';

    protected $fillable = ['tanggal', 'lansia_id', 'berat', 'tekanan_darah', 'lingkar_perut'];

    protected $dates = ['tanggal'];

    // Relasi -> Lansia
    public function lansia()
    {
        return $this->belongsTo(Lansia::class, 'lansia_id');
    }
}

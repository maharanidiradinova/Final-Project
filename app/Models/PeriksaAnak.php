<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class PeriksaAnak extends Model
{
    protected $table = 'periksa_anaks';

    protected $fillable = ['tanggal', 'anak_id', 'berat', 'tinggi'];

    protected $dates = ['tanggal']; 

    // Relasi -> anak
    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}

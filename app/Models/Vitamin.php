<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Vitamin extends Model
{
    protected $fillable = ['anak_id', 'tanggal', 'keterangan'];

    protected $casts = [
        'tanggal' => 'date', // Mengonversi tanggal ke objek Carbon
    ];

    public function anak()
    {
        return $this->belongsTo(Anak::class, 'anak_id');
    }
}

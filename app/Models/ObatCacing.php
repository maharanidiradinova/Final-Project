<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anak;

class ObatCacing extends Model
{
    use HasFactory;

    protected $fillable = [
        'anak_id',
        'tanggal',
        'keterangan',
    ];

    protected $dates = [
        'tanggal',
    ];

    protected $table = 'obatcacings'; 

    public function anak()
    {
        return $this->belongsTo(Anak::class);
    }
    
}

<?php

namespace App\Models;
use App\Models\PeriksaLansia;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lansia extends Model
{
    
    protected $table = 'lansias';

 
    protected $fillable = [
        'nama_lansia',
        'tgl_lahir',
        'jenis_kelamin',
        'umur',
    ];

 
    protected $casts = [
        'tgl_lahir' => 'date',
    ];

   
    public function periksaLansias()
    {
        return $this->hasMany(PeriksaLansia::class, 'lansia_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisImunisasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_imun'];

    public function imunisasi(): HasMany
    {
        return $this->hasMany(Imunisasi::class, 'jenis_imunisasis_id');
    }
}

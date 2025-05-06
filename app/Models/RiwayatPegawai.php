<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiwayatPegawai extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'status_lama',
        'status_baru',
        'tanggal_perubahan',
        'keterangan'
    ];
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

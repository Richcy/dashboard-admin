<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PendidikanPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'pendidikan',
        'nama_sekolah',
        'jurusan',
        'nomor_ijazah',
        'tahun_lulus'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

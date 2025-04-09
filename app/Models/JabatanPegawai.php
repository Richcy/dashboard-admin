<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanPegawai extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'bidang',
        'ruangan',
        'jabatan',
        'jenjang_jabatan',
        'golongan_pangkat',
        'tmt_jabatan',
        'status_jabatan',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

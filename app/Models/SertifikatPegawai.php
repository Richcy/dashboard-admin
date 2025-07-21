<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SertifikatPegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'document_id',
        'jenis_sertifikat',
        'nomor',
        'tgl_terbit',
        'tgl_kadaluarsa',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
        'tanggal_kadaluarsa' => 'date',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function document()
    {
        return $this->belongsTo(DocumentPegawai::class, 'document_id');
    }
}

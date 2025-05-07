<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentPegawai extends Model
{
    //
    use HasFactory;

    protected $fillable = ['pegawai_id', 'jenis_dokumen', 'nama_file', 'path'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

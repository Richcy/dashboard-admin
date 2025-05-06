<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentPegawai extends Model
{
    //
    protected $fillable = ['pegawai_id', 'jenis_dokumen', 'nama_file', 'path'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}

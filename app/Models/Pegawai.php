<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Pegawai extends Model
{
    use HasFactory;

    //protected $table = 'pegawai';

    protected $fillable = [
        'nama_dengan_gelar',
        'nama_tanpa_gelar',
        'jenis_kelamin',
        'nip_npp',
        'tmt_kerja',
        'jenis_tenaga',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'status_asn',
        'tmt_asn',
        'status_perkawinan',
        'tanggungan',
        'alamat',
        'rt',
        'rw',
        'kelurahan_desa',
        'kecamatan',
        'kota_kabupaten',
        'provinsi',
        'bank',
        'nomor_rekening',
        'npwp',
        'nomor_telepon',
        'email',
        'status_pegawai',
    ];

    protected $casts = [
        'tmt_kerja' => 'date',
        'tmt_asn' => 'date',
        'tanggungan' => 'integer',
        'tanggal_lahir' => 'date'
    ];

    public function pendidikan()
    {
        return $this->hasMany(PendidikanPegawai::class);
    }

    public function jabatan()
    {
        return $this->hasMany(JabatanPegawai::class);
    }

    public function jabatanUtama()
    {
        return $this->hasOne(JabatanPegawai::class)->where('status_jabatan', 'utama');
    }

    public function riwayat()
    {
        return $this->hasMany(RiwayatPegawai::class);
    }

    public function documents()
    {
        return $this->hasMany(DocumentPegawai::class);
    }
}

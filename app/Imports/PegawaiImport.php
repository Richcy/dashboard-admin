<?php

namespace App\Imports;

use App\Models\Pegawai;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PegawaiImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Pegawai([
            'nama_dengan_gelar'   => $row['nama_dengan_gelar'],
            'nama_tanpa_gelar'    => $row['nama_tanpa_gelar'],
            'nip_npp'             => $row['nip_npp'],
            'tmt_kerja'           => $row['tmt_kerja'],
            'nik'                 => $row['nik'],
            'tempat_lahir'        => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'       => $row['tanggal_lahir'] ?? null,
            'status_asn'          => $row['status_asn'],
            'tmt_asn'             => $row['tmt_asn'] ?? null,
            'status_perkawinan'   => $row['status_perkawinan'],
            'tanggungan'          => $row['tanggungan'] ?? null,
            'status_pegawai'      => $row['status_pegawai'],
            'alamat'              => $row['alamat'] ?? null,
            'rt'                  => $row['rt'] ?? null,
            'rw'                  => $row['rw'] ?? null,
            'kelurahan_desa'      => $row['kelurahan_desa'] ?? null,
            'kecamatan'           => $row['kecamatan'] ?? null,
            'kota_kabupaten'      => $row['kota_kabupaten'] ?? null,
            'provinsi'            => $row['provinsi'] ?? null,
            'bank'                => $row['bank'] ?? null,
            'nomor_rekening'      => $row['nomor_rekening'] ?? null,
            'npwp'                => $row['npwp'] ?? null,
            'nomor_telepon'       => $row['nomor_telepon'] ?? null,
            'email'               => $row['email'],
        ]);
    }
}

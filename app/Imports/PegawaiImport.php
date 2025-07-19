<?php

namespace App\Imports;

use App\Models\Pegawai;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Carbon\Carbon;

class PegawaiImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {

        //dd($row);

        unset($row['id']);

        return new Pegawai([
            'nama_dengan_gelar'   => $row['nama_dengan_gelar'],
            'nama_tanpa_gelar'    => $row['nama_tanpa_gelar'],
            'jenis_kelamin'       => $row['jenis_kelamin'] ?? 'Laki-Laki',
            'nip_npp'             => $row['nipnpp'],
            'tmt_kerja'           => $this->parseDate($row['tmt_kerja']),
            'jenis_tenaga'        => $row['jenis_tenaga'],
            'nik'                 => $row['nik'],
            'tempat_lahir'        => $row['tempat_lahir'] ?? null,
            'tanggal_lahir'       => $this->parseDate($row['tanggal_lahir'] ?? null),
            'status_asn'          => $row['status_asn'],
            'tmt_asn'             => $this->parseDate($row['tmt_asn'] ?? null),
            'status_perkawinan'   => $row['status_perkawinan'],
            'tanggungan'          => $row['tanggungan'] ?? null,
            'status_pegawai'      => ucfirst($row['status_pegawai']),
            'alamat'              => $row['alamat'] ?? null,
            'rt'                  => $row['rt'] ?? null,
            'rw'                  => $row['rw'] ?? null,
            'kelurahan_desa'      => $row['kelurahandesa'] ?? null, // fixed key
            'kecamatan'           => $row['kecamatan'] ?? null,
            'kota_kabupaten'      => $row['kotakabupaten'] ?? null, // fixed key
            'provinsi'            => $row['provinsi'] ?? null,
            'bank'                => $row['bank'] ?? null,
            'nomor_rekening'      => $row['nomor_rekening'] ?? null,
            'npwp'                => $row['npwp'] ?? null,
            'nomor_telepon'       => $row['nomor_telepon'] ?? null,
            'email'               => $row['email'],
        ]);
    }

    private function convertIndonesianDate($date)
    {
        $indonesianMonths = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December',
        ];

        return strtr($date, $indonesianMonths);
    }

    private function parseDate($date)
    {
        if (!$date) return null;

        try {
            $englishDate = $this->convertIndonesianDate($date);
            return Carbon::parse($englishDate)->format('Y-m-d'); // Or keep as Carbon instance
        } catch (\Exception $e) {
            \Log::error("Date parsing failed: $date", ['error' => $e->getMessage()]);
            return null; // Or throw if you want to block bad data
        }
    }
}

<?php

namespace App\Exports;

use App\Models\Pegawai;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class PegawaiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles, WithColumnFormatting
{
    public function collection()
    {
        return Pegawai::all()->map(function ($pegawai) {
            return [
                'ID' => $pegawai->id,
                'Nama Dengan Gelar'   => $pegawai->nama_dengan_gelar,
                'Nama Tanpa Gelar'    => $pegawai->nama_tanpa_gelar,
                'Jenis Kelamin'       => $pegawai->jenis_kelamin,
                'NIP NPP'             => $pegawai->nip_npp,
                'TMT Kerja'           => optional($pegawai->tmt_kerja)->translatedFormat('d F Y'),
                'NIK'                 => $pegawai->nik,
                'Tempat Lahir'        => $pegawai->tempat_lahir,
                'Tanggal Lahir'       => optional($pegawai->tanggal_lahir)->translatedFormat('d F Y'),
                'Status ASN'          => $pegawai->status_asn,
                'TMT ASN'             => optional($pegawai->tmt_asn)->translatedFormat('d F Y'),
                'Status Perkawinan'   => $pegawai->status_perkawinan,
                'Tanggungan'          => $pegawai->tanggungan,
                'Status Pegawai'      => $pegawai->status_pegawai,
                'Alamat'              => $pegawai->alamat,
                'RT'                  => $pegawai->rt,
                'RW'                  => $pegawai->rw,
                'Kelurahan Desa'      => $pegawai->kelurahan_desa,
                'Kecamatan'           => $pegawai->kecamatan,
                'Kota Kabupaten'      => $pegawai->kota_kabupaten,
                'Provinsi'            => $pegawai->provinsi,
                'Bank'                => $pegawai->bank,
                'Nomor Rekening'      => $pegawai->nomor_rekening,
                'NPWP'                => $pegawai->npwp,
                'Nomor Telepon'       => $pegawai->nomor_telepon,
                'Email'               => $pegawai->email,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Dengan Gelar',
            'Nama Tanpa Gelar',
            'Jenis Kelamin',
            'NIP/NPP',
            'TMT Kerja',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Status ASN',
            'TMT ASN',
            'Status Perkawinan',
            'Tanggungan',
            'Status Pegawai',
            'Alamat',
            'RT',
            'RW',
            'Kelurahan/Desa',
            'Kecamatan',
            'Kota/Kabupaten',
            'Provinsi',
            'Bank',
            'Nomor Rekening',
            'NPWP',
            'Nomor Telepon',
            'Email',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_NUMBER, // NIP/NPP column
            'G' => NumberFormat::FORMAT_NUMBER, // NIK column
            'W' => NumberFormat::FORMAT_NUMBER, // No Rekening column
            'X' => NumberFormat::FORMAT_TEXT, // NPWP column
            'Y' => NumberFormat::FORMAT_NUMBER, // No Telepon column
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $highestColumn = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$highestColumn}1")->getFont()->setBold(true);
    }
}

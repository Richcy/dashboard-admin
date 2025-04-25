<?php

namespace App\Http\Controllers;

use App\Models\JabatanPegawai;
use Illuminate\Http\Request;
use App\Models\Pegawai;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $pegawaiCount = Pegawai::count();

        $aktifCount = Pegawai::where('status_pegawai', 'aktif')->count();
        $nonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->count();
        $pnsCount = Pegawai::where('status_asn', 'PNS')->count();
        $pppkCount = Pegawai::where('status_asn', 'PPPK')->count();
        $kontrakCount = Pegawai::where('status_asn', 'Kontrak BLUD')->count();

        // Aktif status
        $pnsAktifCount = Pegawai::where('status_pegawai', 'aktif')->where('status_asn', 'PNS')->count();
        $pppkAktifCount = Pegawai::where('status_pegawai', 'aktif')->where('status_asn', 'PPPK')->count();
        $kontrakAktifCount = Pegawai::where('status_pegawai', 'aktif')->where('status_asn', 'Kontrak BLUD')->count();

        // NonAktif status
        $pnsNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'PNS')->count();
        $pppkNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'PPPK')->count();
        $kontrakNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'Kontrak BLUD')->count();

        $jabatanPegawaiCount = JabatanPegawai::count();

        $utamaCount = JabatanPegawai::where('status_jabatan', 'utama')->count();
        $tambahanCount = JabatanPegawai::where('status_jabatan', 'tambahan')->count();
        $jabatanUtamaCounts = JabatanPegawai::where('status_jabatan', 'utama')
            ->select('jabatan', \DB::raw('count(*) as total'))
            ->groupBy('jabatan')
            ->get();

        $chartData = [
            'labels' => ['Aktif', 'Nonaktif'],
            'data' => [
                $aktifCount,
                $nonAktifCount
            ],
            'backgroundColor' => ['#4e73df', '#e74a3b'],
        ];


        $chartData2 = [
            'labels' => ['Utama', 'Tambahan'],
            'data' => [
                $utamaCount,
                $tambahanCount
            ],
            'backgroundColor' => ['#4e73df', '#e74a3b'],
        ];

        $jabatanChartLabels = $jabatanUtamaCounts->pluck('jabatan');
        $jabatanChartData = $jabatanUtamaCounts->pluck('total');

        // Pass the data to the view
        return view('dashboard', compact(
            'pegawaiCount',
            'jabatanPegawaiCount',
            'chartData2',
            'chartData',
            'aktifCount',
            'nonAktifCount',
            'utamaCount',
            'tambahanCount',
            'pnsCount',
            'pppkCount',
            'kontrakCount',
            'jabatanUtamaCounts',
            'jabatanChartLabels',
            'jabatanChartData',
            'pnsAktifCount',
            'pppkAktifCount',
            'kontrakAktifCount',
            'pnsNonAktifCount',
            'pppkNonAktifCount',
            'kontrakNonAktifCount'
        ));
    }
}

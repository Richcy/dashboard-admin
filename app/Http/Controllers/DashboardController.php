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

        $nakesAktifCount = Pegawai::where('status_pegawai', 'aktif')->where('jenis_tenaga', 'nakes')->count();
        $nonNakesAktifCount = Pegawai::where('status_pegawai', 'aktif')->where('jenis_tenaga', 'non_nakes')->count();

        // NonAktif status
        $pnsNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'PNS')->count();
        $pppkNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'PPPK')->count();
        $kontrakNonAktifCount = Pegawai::where('status_pegawai', 'nonaktif')->where('status_asn', 'Kontrak BLUD')->count();

        $jabatanPegawaiCount = JabatanPegawai::count();

        $utamaCount = JabatanPegawai::where('status_jabatan', 'utama')->count();
        $tambahanCount = JabatanPegawai::where('status_jabatan', 'tambahan')->count();
        $jabatanUtamaCounts = JabatanPegawai::where('status_jabatan', 'utama')
            ->whereHas('pegawai', function ($query) {
                $query->where('status_pegawai', 'aktif');
            })
            ->select('jabatan', \DB::raw('count(*) as total'))
            ->groupBy('jabatan')
            ->get();

        // Get all pegawai records with their pendidikan, ordered by the rank of pendidikan
        $pegawais = Pegawai::with('pendidikan')
            ->get(); // Or use ->paginate() if you want pagination

        // Define the degree order to be used for sorting
        $degreeOrder = ['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'];

        // Create an array to hold the count of pegawai with each degree
        $degreeCount = [];

        // Loop through each pegawai to determine their latest pendidikan
        foreach ($pegawais as $pegawai) {
            // Sort the pendidikan records for the pegawai
            $latestPendidikan = $pegawai->pendidikan
                ->sortByDesc(fn($p) => array_search($p->pendidikan, $degreeOrder))
                ->first();

            // Check if the pendidikan level exists in the count array, if not, initialize it
            if (isset($latestPendidikan)) {
                $degreeCount[$latestPendidikan->pendidikan] = ($degreeCount[$latestPendidikan->pendidikan] ?? 0) + 1;
            }
        }

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

        $chartData3 = [
            'labels' => ['PNS', 'PPPK', 'Kontrak BLUD', 'Total Pegawai Aktif'],
            'data' => [
                $pnsAktifCount,
                $pppkAktifCount,
                $kontrakAktifCount,
                $aktifCount
            ],
            'backgroundColor' => ['#4e73df', '#1fde52', '#e74a3b', '#d1de1f'],
        ];

        $jabatanChartLabels = $jabatanUtamaCounts->pluck('jabatan');
        $jabatanChartData = $jabatanUtamaCounts->pluck('total');

        // Add color + icon processing here
        $themeColors = ['primary', 'secondary', 'info', 'success', 'danger', 'warning', 'dark'];
        $iconDefault = 'fas fa-briefcase';

        // Prepare boxed data for display
        $jabatanInfoBoxes = [];
        foreach ($jabatanChartLabels as $index => $jabatan) {
            $jabatanInfoBoxes[] = [
                'title' => $jabatan,
                'total' => $jabatanChartData[$index],
                'icon' => $iconDefault,
                'theme' => $themeColors[$index % count($themeColors)],
            ];
        }

        $chartJenisTenagaData = [
            'labels' => ['Tenaga Kesehatan', 'Tenaga Non-Kesehatan'],
            'data' => [
                $nakesAktifCount,
                $nonNakesAktifCount
            ],
            'backgroundColor' => ['#4e73df', '#e74a3b', '#d1de1f'],
        ];

        $counts = [
            'pegawaiCount' => $pegawaiCount,
            'jabatanPegawaiCount' => $jabatanPegawaiCount,
            'aktifCount' => $aktifCount,
            'nonAktifCount' => $nonAktifCount,
            'utamaCount' => $utamaCount,
            'tambahanCount' => $tambahanCount,
            'pnsCount' => $pnsCount,
            'pppkCount' => $pppkCount,
            'kontrakCount' => $kontrakCount,
            'pnsAktifCount' => $pnsAktifCount,
            'pppkAktifCount' => $pppkAktifCount,
            'kontrakAktifCount' => $kontrakAktifCount,
            'pnsNonAktifCount' => $pnsNonAktifCount,
            'pppkNonAktifCount' => $pppkNonAktifCount,
            'kontrakNonAktifCount' => $kontrakNonAktifCount,
            'degreeCount' => $degreeCount,
            'jabatanInfoBoxes' => $jabatanInfoBoxes,
        ];

        $charts = [
            'chartData' => $chartData,
            'chartData2' => $chartData2,
            'chartData3' => $chartData3,
            'jabatanChartLabels' => $jabatanChartLabels,
            'jabatanChartData' => $jabatanChartData,
            'jabatanUtamaCounts' => $jabatanUtamaCounts,
            'chartJenisTenagaData' => $chartJenisTenagaData
        ];

        // Pass the data to the view
        return view('dashboard', array_merge($counts, $charts));
    }
}

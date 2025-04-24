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
        // Count of total employees
        $pegawaiCount = Pegawai::count();

        // Count of active and non-active employees
        $aktifCount = Pegawai::where('status_pegawai', 'aktif')->count();
        $nonAktifCount = Pegawai::where('status_pegawai', 'resign')->count();

        // Count of total positions
        $jabatanPegawaiCount = JabatanPegawai::count();

        // Count of primary and additional positions
        $utamaCount = JabatanPegawai::where('status_jabatan', 'utama')->count();
        $tambahanCount = JabatanPegawai::where('status_jabatan', 'tambahan')->count();

        // Chart data for Status Pegawai (Employee Status)
        $chartData = [
            'labels' => ['Aktif', 'Nonaktif'],  // Labels for the x-axis
            'data' => [
                $aktifCount,  // Data for active employees
                $nonAktifCount  // Data for non-active employees
            ],
            'backgroundColor' => ['#4e73df', '#e74a3b'],  // Colors for each segment
        ];

        // Chart data for Status Jabatan Pegawai (Position Status)
        $chartData2 = [
            'labels' => ['Utama', 'Tambahan'],  // Labels for the x-axis
            'data' => [
                $utamaCount,  // Data for main positions
                $tambahanCount  // Data for additional positions
            ],
            'backgroundColor' => ['#4e73df', '#e74a3b'],  // Colors for each segment
        ];

        // Pass the data to the view
        return view('dashboard', compact('pegawaiCount', 'jabatanPegawaiCount', 'chartData2', 'chartData', 'aktifCount', 'nonAktifCount', 'utamaCount', 'tambahanCount'));
    }
}

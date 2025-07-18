<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pegawai;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;
use Carbon\Carbon;
use App\Models\RiwayatPegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $pegawai = Pegawai::all()->map(function ($pegawai) {
        //     // Calculate Masa Kerja (Length of Service)
        //     $masaKerja = Carbon::parse($pegawai->tmt_kerja);
        //     $years = $masaKerja->diffInYears(Carbon::now());
        //     $months = $masaKerja->diffInMonths(Carbon::now()) % 12; // Get the remaining months after years

        //     $masaKerja = "{$years} Tahun {$months} Bulan";

        //     // Add the calculated Masa Kerja to the pegawai object
        //     $pegawai->masa_kerja = $masaKerja;
        //     return $pegawai;
        // });

        return view('pegawai.index');
    }

    // public function getPegawai(Request $request)
    // {
    //     $pegawai = Pegawai::select(['id', 'nama_dengan_gelar', 'nip_npp', 'status_asn', 'nomor_telepon', 'status_pegawai']);

    //     return DataTables::of($pegawai)
    //         ->addColumn('action', function ($row) {
    //             $showUrl = route('pegawai.show', $row->id);
    //             $deleteUrl = route('pegawai.destroy', $row->id);
    //             return '
    //         <a href="' . $showUrl . '" class="btn btn-sm btn-info">Show</a>
    //         <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
    //             ' . csrf_field() . method_field('DELETE') . '
    //             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus data?\')">Hapus</button>
    //         </form>
    //     ';
    //         })
    //         ->addIndexColumn()
    //         ->rawColumns(['action'])
    //         ->make(true);
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $previousUrl = url()->previous();
        $backUrl = route('pegawai.aktif'); // Default fallback

        if (Str::contains($previousUrl, 'pegawai-nonaktif')) {
            $backUrl = route('pegawai.nonaktif');
        } elseif (Str::contains($previousUrl, 'pegawai-aktif')) {
            $backUrl = route('pegawai.aktif');
        }

        return view('pegawai.create', compact('backUrl'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_dengan_gelar' => 'required|string',
            'nama_tanpa_gelar' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'nip_npp' => 'required|unique:pegawais',
            'tmt_kerja' => 'required|date',
            'jenis_tenaga' => 'nullable|in:struktural,nakes,non_nakes',
            'nik' => 'required|unique:pegawais',

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',

            'status_asn' => 'required|in:PNS,PPPK,Kontrak BLUD',
            'tmt_asn' => 'nullable|date',

            'status_pegawai' => 'required|in:aktif,nonaktif',
            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'tanggungan' => 'nullable|string',

            'alamat' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'kelurahan_desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota_kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',

            'bank' => 'nullable|string',
            'nomor_rekening' => 'nullable|string',
            'npwp' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $data = $request->all();

        $data['status_asn'] = $data['status_asn'] ?? 'Kontrak BLUD';
        $data['status_perkawinan'] = $data['status_perkawinan'] ?? 'Belum Kawin';
        $data['status_pegawai'] = $data['status_pegawai'] ?? 'aktif';

        Pegawai::create($data);

        return redirect()->route(
            $request->status_pegawai === 'aktif' ? 'pegawai.aktif' : 'pegawai.nonaktif'
        )->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $previousUrl = url()->previous();
        $backUrl = route('pegawai.aktif'); // Default fallback

        if (Str::contains($previousUrl, 'pegawai-nonaktif')) {
            $backUrl = route('pegawai.nonaktif');
        } elseif (Str::contains($previousUrl, 'pegawai-aktif')) {
            $backUrl = route('pegawai.aktif');
        }
        $pegawai = Pegawai::with(['pendidikan', 'jabatan'])->findOrFail($id);

        // Calculate 'umur' for the specific pegawai
        $umur = Carbon::parse($pegawai->tanggal_lahir);
        $totalMonths = $umur->diffInMonths(Carbon::now());
        $years = intdiv($totalMonths, 12); // Full years
        // $months = $totalMonths % 12; // Remaining months
        // $remainingDays = (int) $umur->addYears($years)->addMonths($months)->diffInDays(Carbon::now());

        // Format umur
        $umur = "{$years} Tahun";

        // Add umur to the pegawai instance (if needed in the view)
        $pegawai->umur = $umur;

        // Calculate 'umur' for the specific pegawai
        $masaKerja = Carbon::parse($pegawai->tmt_kerja);
        $totalMonths = $masaKerja->diffInMonths(Carbon::now());
        $years = intdiv($totalMonths, 12); // Full years
        $months = $totalMonths % 12; // Remaining months
        // $remainingDays = (int) $masaKerja->addYears($years)->addMonths($months)->diffInDays(Carbon::now());

        // Format umur
        $masaKerja = "{$years} Tahun {$months} Bulan";

        // Add umur to the pegawai instance (if needed in the view)
        $pegawai->masaKerja = $masaKerja;

        $jenisTenagaMap = [
            'nakes' => 'Tenaga Kesehatan',
            'non_nakes' => 'Tenaga Non-Kesehatan',
        ];

        $posisiJabatanMap = [
            'struktural' => 'Struktural',
            'jabfung' => 'Jabatan Fungsional',
            'pelaksana' => 'Pelaksana',
            'honorer' => 'Honorer',
        ];

        $pegawai->jenis_tenaga_label = $jenisTenagaMap[$pegawai->jenis_tenaga] ?? '-';
        $pegawai->posisi_jabatan_label = $posisiJabatanMap[$pegawai->posisi_jabatan] ?? '-';

        return view('pegawai.show', compact('pegawai', 'backUrl', 'umur', 'masaKerja'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the Pegawai by ID
        $pegawai = Pegawai::findOrFail($id);

        // Return the view and pass 'pegawai' and 'umur' variables
        return view('pegawai.edit', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $pegawai = Pegawai::findOrFail($id);

        $request->validate([
            'nama_dengan_gelar' => 'required|string',
            'nama_tanpa_gelar' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan',
            'nip_npp' => 'required|unique:pegawais,nip_npp,' . $pegawai->id,
            'tmt_kerja' => 'required|date',
            'jenis_tenaga' => 'nullable|in:struktural,nakes,non_nakes',
            'posisi_jabatan' => 'nullable|in:struktural,jabfung,pelaksana,honorer',
            'nik' => 'required|unique:pegawais,nik,' . $pegawai->id,

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',

            'status_asn' => 'required|in:PNS,PPPK,Kontrak BLUD',
            'tmt_asn' => 'nullable|date',

            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'tanggungan' => 'nullable|string',

            'status_pegawai' => 'required|in:aktif,nonaktif',

            'alamat' => 'nullable|string',
            'rt' => 'nullable|string',
            'rw' => 'nullable|string',
            'kelurahan_desa' => 'nullable|string',
            'kecamatan' => 'nullable|string',
            'kota_kabupaten' => 'nullable|string',
            'provinsi' => 'nullable|string',

            'bank' => 'nullable|string',
            'nomor_rekening' => 'nullable|string',
            'npwp' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $oldStatus = $pegawai->status_pegawai; // old value
        $newStatus = $request->input('status_pegawai'); // new value from form

        if ($oldStatus !== $newStatus) {
            RiwayatPegawai::create([
                'pegawai_id' => $pegawai->id,
                'status_lama' => $oldStatus,
                'status_baru' => $newStatus,
                'tanggal_perubahan' => now(),
                'keterangan' => $request->input('alasan_perubahan'),
            ]);
        }

        $pegawai->update($request->all());

        // Check if status_pegawai changed and redirect accordingly
        if ($oldStatus !== $newStatus) {
            if ($newStatus === 'aktif') {
                return redirect()->route('pegawai.aktif')->with('success', 'Status pegawai diubah menjadi Aktif.');
            } elseif ($newStatus === 'nonaktif') {
                return redirect()->route('pegawai.nonaktif')->with('success', 'Status pegawai diubah menjadi Non Aktif.');
            }
        }

        // If status didn't change, redirect based on current status
        if ($newStatus === 'aktif') {
            return redirect()->route('pegawai.aktif')->with('success', 'Data pegawai berhasil diperbarui.');
        } else {
            return redirect()->route('pegawai.nonaktif')->with('success', 'Data pegawai berhasil diperbarui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        //
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route(
            $request->status_pegawai === 'aktif' ? 'pegawai.aktif' : 'pegawai.nonaktif'
        )->with('success', 'Data pegawai berhasil dihapus.');
    }

    public function aktif()
    {
        return view('pegawai.index', ['status' => 'aktif']);
    }

    public function nonaktif()
    {
        return view('pegawai.index', ['status' => 'nonaktif']);
    }

    public function getData($status)
    {
        $pegawais = Pegawai::with('jabatanUtama')->where('status_pegawai', $status)->get();

        $pegawais = $pegawais->map(function ($item) {
            $masaKerja = Carbon::parse($item->tmt_kerja);
            $totalMonths = $masaKerja->diffInMonths(Carbon::now());
            $years = intdiv($totalMonths, 12);
            $months = $totalMonths % 12;

            $item->masa_kerja = "{$years} Tahun {$months} Bulan";

            return $item;
        });

        return DataTables::of($pegawais)
            ->addColumn('jabatan_utama', function ($row) {
                return $row->jabatanUtama?->jabatan ?? '-';
            })
            ->addColumn('action', function ($row) {
                $showUrl = route('pegawai.show', $row->id);
                $deleteUrl = route('pegawai.destroy', $row->id);
                return '
                <a href="' . $showUrl . '" class="btn btn-sm btn-info">Show</a>
                <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                    ' . csrf_field() . method_field('DELETE') . '
                    <input type="hidden" name="status_pegawai" value="' . $row->status_pegawai . '">
                    <button type="button" class="btn btn-sm btn-danger delete-confirm">Hapus</button>
                </form>';
            })
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->make(true);
    }


    public function export()
    {
        return Excel::download(new PegawaiExport, 'data-pegawai.xlsx');
    }

    public function import(Request $request)
    {
        // Validate file input
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        try {
            // Import the file
            Excel::import(new PegawaiImport, $request->file('file'));

            // If import is successful, return a success message
            return back()->with('success', 'Import data pegawai berhasil!');
        } catch (\Maatwebsite\Excel\ExcelException $e) {
            // If an error occurs during import, log the error and return a failure message
            Log::error('Import Error: ' . $e->getMessage());

            // You can also check if there's specific information on the exception and return that
            return back()->with('error', 'Terjadi kesalahan saat mengimpor data pegawai. Silakan coba lagi.');
        }
    }
}

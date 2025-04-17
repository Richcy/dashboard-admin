<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Pegawai;
use Yajra\DataTables\Facades\DataTables;
use App\Exports\PegawaiExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PegawaiImport;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'nip_npp' => 'required|unique:pegawais',
            'tmt_kerja' => 'required|date',
            'nik' => 'required|unique:pegawais',

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',

            'status_asn' => 'required|in:PNS,PPPK,Kontrak BLUD',
            'tmt_asn' => 'nullable|date',

            'status_pegawai' => 'required|in:aktif,resign',
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
        return view('pegawai.show', compact('pegawai', 'backUrl'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $pegawai = Pegawai::findOrFail($id);
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
            'nip_npp' => 'required|unique:pegawais,nip_npp,' . $pegawai->id,
            'tmt_kerja' => 'required|date',
            'nik' => 'required|unique:pegawais,nik,' . $pegawai->id,

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',

            'status_asn' => 'required|in:PNS,PPPK,Kontrak BLUD',
            'tmt_asn' => 'nullable|date',

            'status_perkawinan' => 'required|in:Kawin,Belum Kawin,Cerai Hidup,Cerai Mati',
            'tanggungan' => 'nullable|string',

            'status_pegawai' => 'required|in:aktif,resign',

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

        $oldStatus = $pegawai->status_pegawai; // get current status before update

        $pegawai->update($request->all());

        $newStatus = $request->status_pegawai;

        // Check if status_pegawai changed and redirect accordingly
        if ($oldStatus !== $newStatus) {
            if ($newStatus === 'aktif') {
                return redirect()->route('pegawai.aktif')->with('success', 'Status pegawai diubah menjadi Aktif.');
            } elseif ($newStatus === 'resign') {
                return redirect()->route('pegawai.nonaktif')->with('success', 'Status pegawai diubah menjadi Resign.');
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
    public function destroy(string $id)
    {
        //
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil dihapus');
    }

    public function aktif()
    {
        return view('pegawai.index', ['status' => 'Aktif']);
    }

    public function nonaktif()
    {
        return view('pegawai.index', ['status' => 'Resign']);
    }

    public function getData($status)
    {
        $pegawais = Pegawai::where('status_pegawai', $status)->select('*');

        return DataTables::of($pegawais)
            ->addColumn('action', function ($row) {
                $showUrl = route('pegawai.show', $row->id);
                $deleteUrl = route('pegawai.destroy', $row->id);
                return '
        <a href="' . $showUrl . '" class="btn btn-sm btn-info">Show</a>
        <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
            ' . csrf_field() . method_field('DELETE') . '
            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Semua data pegawai ini akan terhapus.\nHapus data?\')">Hapus</button>

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
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,xls'
        ]);

        Excel::import(new PegawaiImport, $request->file('file'));

        return back()->with('success', 'Import data pegawai berhasil!');
    }
}

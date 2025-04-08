<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use Yajra\DataTables\Facades\DataTables;

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

    public function getPegawai(Request $request)
    {
        $pegawai = Pegawai::select(['id', 'nama_dengan_gelar', 'nip_npp', 'status_asn', 'email']);

        return DataTables::of($pegawai)
            ->addColumn('action', function ($row) {
                $editUrl = route('pegawai.edit', $row->id);
                $deleteUrl = route('pegawai.destroy', $row->id);
                return '
                    <a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
                    <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus data?\')">Hapus</button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pegawai.create');
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
            'status_asn' => 'nullable|string',
            'tmt_asn' => 'nullable|date',
            'status_perkawinan' => 'nullable|string',
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

        Pegawai::create($request->all());
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $pegawai = Pegawai::findOrFail($id);
        return view('pegawai.show', compact('pegawai'));
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
        $request->validate([
            'nama_dengan_gelar' => 'required|string',
            'nama_tanpa_gelar' => 'required|string',
            'nip_npp' => 'required|unique:pegawais,nip_npp,' . $id,
            'tmt_kerja' => 'required|date',
            'nik' => 'required|unique:pegawais,nik,' . $id,
            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'status_asn' => 'nullable|string',
            'tmt_asn' => 'nullable|date',
            'status_perkawinan' => 'nullable|string',
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

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->update($request->all());

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui');
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
}

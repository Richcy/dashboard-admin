<?php

namespace App\Http\Controllers;

use App\Models\SertifikatPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SertifikatPegawaiController extends Controller
{
    public function index()
    {
        return view('sertifikat-pegawai.index');
    }

    public function getData(Request $request)
    {
        $sertifikat = SertifikatPegawai::with('pegawai')->select('sertifikat_pegawais.*');

        return DataTables::of($sertifikat)
            ->addColumn('pegawai_nama', function ($row) {
                return $row->pegawai->nama_dengan_gelar ?? '-';
            })
            ->addIndexColumn()
            // ->addColumn('action', function ($row) {
            //     $showUrl = route('sertifikat-pegawai.show', $row->id);
            //     $editUrl = route('sertifikat-pegawai.edit', $row->id);
            //     $deleteUrl = route('sertifikat-pegawai.destroy', $row->id);
            //     return '
            //         <a href="' . $showUrl . '" class="btn btn-sm btn-info">Show</a>
            //         <a href="' . $editUrl . '" class="btn btn-sm btn-warning">Edit</a>
            //         <form action="' . $deleteUrl . '" method="POST" style="display:inline;">
            //             ' . csrf_field() . method_field('DELETE') . '
            //             <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Hapus data?\')">Hapus</button>
            //         </form>
            //     ';
            // })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('sertifikat-pegawai.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'jenis_sertifikat' => 'required|string',
            'nomor' => 'required|string',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
        ]);

        SertifikatPegawai::create($request->all());

        return redirect()->route('sertifikat-pegawai.index')->with('success', 'Data sertifikat berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $sertifikat = SertifikatPegawai::with('pegawai')->findOrFail($id);
        return view('sertifikat-pegawai.show', compact('sertifikat'));
    }

    public function edit(string $id)
    {
        $sertifikat = SertifikatPegawai::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('sertifikat-pegawai.edit', compact('sertifikat', 'pegawais'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'jenis_sertifikat' => 'required|string',
            'nomor' => 'required|string',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
        ]);

        $sertifikat = SertifikatPegawai::findOrFail($id);
        $sertifikat->update($request->all());

        return redirect()->route('sertifikat-pegawai.index')->with('success', 'Data sertifikat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $sertifikat = SertifikatPegawai::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('sertifikat-pegawai.index')->with('success', 'Data sertifikat berhasil dihapus');
    }
}

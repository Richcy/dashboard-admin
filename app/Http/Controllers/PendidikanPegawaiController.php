<?php

namespace App\Http\Controllers;

use App\Models\PendidikanPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PendidikanPegawaiController extends Controller
{
    public function index()
    {
        return view('pendidikan-pegawai.index');
    }

    public function getData(Request $request)
    {
        $pendidikan = PendidikanPegawai::with('pegawai')->select('pendidikan_pegawais.*');

        return DataTables::of($pendidikan)
            ->addColumn('pegawai_nama', function ($row) {
                return $row->pegawai->nama_dengan_gelar ?? '-';
            })
            ->addIndexColumn()
            // ->addColumn('action', function ($row) {
            //     $showUrl = route('pendidikan-pegawai.show', $row->id);
            //     $editUrl = route('pendidikan-pegawai.edit', $row->id);
            //     $deleteUrl = route('pendidikan-pegawai.destroy', $row->id);
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
        return view('pendidikan-pegawai.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'pendidikan' => 'required|string',
            'nama_sekolah' => 'required|string',
            'jurusan' => 'required|string',
            'nomor_ijazah' => 'required|string',
            'tahun_lulus' => 'required|digits:4|integer',
        ]);

        PendidikanPegawai::create($request->all());

        return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $pendidikan = PendidikanPegawai::with('pegawai')->findOrFail($id);
        return view('pendidikan-pegawai.show', compact('pendidikan'));
    }

    public function edit(string $id)
    {
        $pendidikan = PendidikanPegawai::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('pendidikan-pegawai.edit', compact('pendidikan', 'pegawais'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'pendidikan' => 'required|string',
            'nama_sekolah' => 'required|string',
            'jurusan' => 'required|string',
            'nomor_ijazah' => 'required|string',
            'tahun_lulus' => 'required|digits:4|integer',
        ]);

        $pendidikan = PendidikanPegawai::findOrFail($id);
        $pendidikan->update($request->all());

        return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $pendidikan = PendidikanPegawai::findOrFail($id);
        $pendidikan->delete();

        return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil dihapus');
    }
}

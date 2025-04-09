<?php

namespace App\Http\Controllers;

use App\Models\JabatanPegawai;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class JabatanPegawaiController extends Controller
{
    public function index()
    {
        return view('jabatan-pegawai.index');
    }

    public function getData(Request $request)
    {
        $jabatan = JabatanPegawai::with('pegawai')->select('jabatan_pegawais.*');

        return DataTables::of($jabatan)
            ->addColumn('pegawai_nama', function ($row) {
                return $row->pegawai->nama_dengan_gelar ?? '-';
            })
            ->editColumn('tmt_jabatan', function ($row) {
                return $row->tmt_jabatan ? \Carbon\Carbon::parse($row->tmt_jabatan)->translatedFormat('j F Y') : '-';
            })
            ->addColumn('action', function ($row) {
                $showUrl = route('jabatan-pegawai.show', $row->id);
                $editUrl = route('jabatan-pegawai.edit', $row->id);
                $deleteUrl = route('jabatan-pegawai.destroy', $row->id);
                return '
                    <a href="' . $showUrl . '" class="btn btn-sm btn-info">Show</a>
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

    public function create()
    {
        $pegawais = Pegawai::all();
        return view('jabatan-pegawai.create', compact('pegawais'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'bidang' => 'required|string',
            'ruangan' => 'required|string',
            'jabatan' => 'required|string',
            'jenjang_jabatan' => 'required|string',
            'golongan_pangkat' => 'required|string',
            'tmt_jabatan' => 'required|date',
            'status_jabatan' => 'required|in:utama,tambahan',
        ]);

        JabatanPegawai::create($request->all());

        return redirect()->route('jabatan-pegawai.index')->with('success', 'Data jabatan berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $jabatan = JabatanPegawai::with('pegawai')->findOrFail($id);
        return view('jabatan-pegawai.show', compact('jabatan'));
    }

    public function edit(string $id)
    {
        $jabatan = JabatanPegawai::findOrFail($id);
        $pegawais = Pegawai::all();
        return view('jabatan-pegawai.edit', compact('jabatan', 'pegawais'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'pegawai_id' => 'required|exists:pegawais,id',
            'bidang' => 'required|string',
            'ruangan' => 'required|string',
            'jabatan' => 'required|string',
            'jenjang_jabatan' => 'required|string',
            'golongan_pangkat' => 'required|string',
            'tmt_jabatan' => 'required|date',
            'status_jabatan' => 'required|in:utama,tambahan',
        ]);

        $jabatan = JabatanPegawai::findOrFail($id);
        $jabatan->update($request->all());

        return redirect()->route('jabatan-pegawai.index')->with('success', 'Data jabatan berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $jabatan = JabatanPegawai::findOrFail($id);
        $jabatan->delete();

        return redirect()->route('jabatan-pegawai.index')->with('success', 'Data jabatan berhasil dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPegawai;
use Yajra\DataTables\Facades\DataTables;

class RiwayatPegawaiController extends Controller
{
    //
    public function index()
    {
        return view('riwayat-pegawai.index');
    }

    public function getData(Request $request)
    {
        $riwayat = RiwayatPegawai::with('pegawai')->select('riwayat_pegawais.*');

        return DataTables::of($riwayat)
            ->addColumn('pegawai_nama', function ($row) {
                return $row->pegawai->nama_dengan_gelar ?? '-';
            })
            ->addColumn('riwayat', function ($row) {
                return 'Dari <strong>' . ucfirst($row->status_lama) . '</strong> ke <strong>' . ucfirst($row->status_baru) . '</strong>';
            })
            ->addColumn('tanggal', function ($row) {
                return \Carbon\Carbon::parse($row->tanggal_perubahan)->format('d-m-Y');
            })
            ->addColumn('keterangan', function ($row) {
                return $row->keterangan ?? '-';
            })
            ->addIndexColumn()
            ->rawColumns(['riwayat']) // Allow HTML formatting in riwayat
            ->make(true);
    }

    // public function create()
    // {
    //     $pegawais = Pegawai::all();
    //     return view('pendidikan-pegawai.create', compact('pegawais'));
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'pegawai_id' => 'required|exists:pegawais,id',
    //         'pendidikan' => 'required|string',
    //         'nama_sekolah' => 'required|string',
    //         'jurusan' => 'required|string',
    //         'nomor_ijazah' => 'required|string',
    //         'tahun_lulus' => 'required|digits:4|integer',
    //     ]);

    //     PendidikanPegawai::create($request->all());

    //     return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil ditambahkan');
    // }

    // public function show(string $id)
    // {
    //     $pendidikan = PendidikanPegawai::with('pegawai')->findOrFail($id);
    //     return view('pendidikan-pegawai.show', compact('pendidikan'));
    // }

    // public function edit(string $id)
    // {
    //     $pendidikan = PendidikanPegawai::findOrFail($id);
    //     $pegawais = Pegawai::all();
    //     return view('pendidikan-pegawai.edit', compact('pendidikan', 'pegawais'));
    // }

    // public function update(Request $request, string $id)
    // {
    //     $request->validate([
    //         'pegawai_id' => 'required|exists:pegawais,id',
    //         'pendidikan' => 'required|string',
    //         'nama_sekolah' => 'required|string',
    //         'jurusan' => 'required|string',
    //         'nomor_ijazah' => 'required|string',
    //         'tahun_lulus' => 'required|digits:4|integer',
    //     ]);

    //     $pendidikan = PendidikanPegawai::findOrFail($id);
    //     $pendidikan->update($request->all());

    //     return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil diperbarui');
    // }

    // public function destroy(string $id)
    // {
    //     $pendidikan = PendidikanPegawai::findOrFail($id);
    //     $pendidikan->delete();

    //     return redirect()->route('pendidikan-pegawai.index')->with('success', 'Data pendidikan berhasil dihapus');
    // }
}

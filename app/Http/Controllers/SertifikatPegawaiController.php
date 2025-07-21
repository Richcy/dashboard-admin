<?php

namespace App\Http\Controllers;

use App\Models\SertifikatPegawai;
use App\Models\Pegawai;
use App\Models\DocumentPegawai;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

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
            ->editColumn('tgl_terbit', function ($row) {
                return $row->tgl_terbit ? \Carbon\Carbon::parse($row->tgl_terbit)->translatedFormat('j F Y') : '-';
            })
            ->editColumn('tgl_kadaluarsa', function ($row) {
                return $row->tgl_kadaluarsa ? \Carbon\Carbon::parse($row->tgl_kadaluarsa)->translatedFormat('j F Y') : '-';
            })
            ->addColumn('file', function ($row) {
                if ($row->document && $row->document->path) {
                    $ext = pathinfo($row->document->path, PATHINFO_EXTENSION);
                    $url = asset('storage/' . $row->document->path);

                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                        return '<a href="' . $url . '" target="_blank"><img src="' . $url . '" alt="file" width="60" style="cursor: pointer;" title="Lihat File"></a>';
                    } else {
                        return '<a href="' . $url . '" target="_blank">Lihat File</a>';
                    }
                }
                return '<span class="text-muted">-</span>';
            })
            ->rawColumns(['file', 'action'])
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
            'jenis_sertifikat' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ]);

        $sertifikat = new SertifikatPegawai();
        $sertifikat->pegawai_id = $request->pegawai_id;
        $sertifikat->jenis_sertifikat = $request->jenis_sertifikat;
        $sertifikat->nomor = $request->nomor;
        $sertifikat->tgl_terbit = $request->tgl_terbit;
        $sertifikat->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $sertifikat->save();

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('sertifikat_files', 'public');

            $document = new DocumentPegawai();
            $document->path = $path;
            $document->nama_file = 'Sertifikat - ' . $sertifikat->jenis_sertifikat;
            $document->jenis_dokumen = 'sertifikat';
            $document->pegawai_id = $sertifikat->pegawai_id;
            $document->save();

            $sertifikat->document_id = $document->id;
            $sertifikat->save();
        }

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
            'jenis_sertifikat' => 'required|string|max:255',
            'nomor' => 'required|string|max:255',
            'tgl_terbit' => 'required|date',
            'tgl_kadaluarsa' => 'required|date',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:2048',
        ]);

        $sertifikat = SertifikatPegawai::findOrFail($id);
        $sertifikat->pegawai_id = $request->pegawai_id;
        $sertifikat->jenis_sertifikat = $request->jenis_sertifikat;
        $sertifikat->nomor = $request->nomor;
        $sertifikat->tgl_terbit = $request->tgl_terbit;
        $sertifikat->tgl_kadaluarsa = $request->tgl_kadaluarsa;
        $sertifikat->save();

        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($sertifikat->document && $sertifikat->document->path) {
                Storage::disk('public')->delete($sertifikat->document->path);
                $sertifikat->document->delete();
            }

            $path = $request->file('file')->store('sertifikat_files', 'public');

            $document = new DocumentPegawai();
            $document->path = $path;
            $document->nama_file = 'Sertifikat - ' . $sertifikat->jenis_sertifikat;
            $document->jenis_dokumen = 'sertifikat';
            $document->pegawai_id = $sertifikat->pegawai_id;
            $document->save();

            $sertifikat->document_id = $document->id;
            $sertifikat->save();
        }

        return redirect()->route('sertifikat-pegawai.index')->with('success', 'Data sertifikat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $sertifikat = SertifikatPegawai::findOrFail($id);
        $sertifikat->delete();

        return redirect()->route('sertifikat-pegawai.index')->with('success', 'Data sertifikat berhasil dihapus');
    }
}

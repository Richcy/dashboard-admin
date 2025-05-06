<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\DocumentPegawai;
use Illuminate\Support\Facades\Storage;

class DocumentPegawaiController extends Controller
{
    //
    public function create($pegawaiId)
    {
        $pegawai = Pegawai::findOrFail($pegawaiId);
        return view('document-pegawai.create', compact('pegawai'));
    }

    public function store(Request $request, $pegawaiId)
    {
        $request->validate([
            'jenis_dokumen' => 'required|string',
            'file' => 'required|file|max:2048'
        ]);

        $file = $request->file('file');
        $path = $file->store('dokumen-pegawai');

        DocumentPegawai::create([
            'pegawai_id' => $pegawaiId,
            'jenis_dokumen' => $request->jenis_dokumen,
            'nama_file' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return redirect()->route('pegawai.show', $pegawaiId)->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|max:2048', // 2MB max
        ]);

        $pegawai = Pegawai::findOrFail($id);

        // Delete old photo if it exists
        $oldFoto = DocumentPegawai::where('pegawai_id', $id)
            ->where('jenis_dokumen', 'foto')
            ->first();

        if ($oldFoto && Storage::disk('public')->exists($oldFoto->path)) {
            Storage::disk('public')->delete($oldFoto->path);
            $oldFoto->delete();
        }

        $path = $request->file('foto')->store('pegawai_foto', 'public');

        DocumentPegawai::create([
            'pegawai_id' => $id,
            'jenis_dokumen' => 'foto',
            'nama_file' => $request->file('foto')->getClientOriginalName(),
            'path' => $path,
        ]);

        return redirect()->back()->with('success', 'Foto pegawai berhasil diperbarui.');
    }
}

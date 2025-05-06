@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Upload Dokumen Pegawai: {{ $pegawai->nama_dengan_gelar }}</h4>

    <form action="{{ route('document-pegawai.store', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
            <input type="text" name="jenis_dokumen" class="form-control @error('jenis_dokumen') is-invalid @enderror" value="{{ old('jenis_dokumen') }}">
            @error('jenis_dokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="file" class="form-label">Pilih File</label>
            <input type="file" name="file" class="form-control @error('file') is-invalid @enderror">
            @error('file') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
</div>
@endsection
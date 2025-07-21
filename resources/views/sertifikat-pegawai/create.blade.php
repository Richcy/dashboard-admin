@extends('layouts.app')

@section('content_body')
<div class="container">
    <!-- <div class="text-start">
        <h2>Input Data</h2>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Tambah Data Sertifikat Pegawai</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <!-- <span class="badge badge-primary">Label</span> -->
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <form action="{{ route('sertifikat-pegawai.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="card-body">
                        <!-- Pegawai -->
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id">
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach($pegawais as $p)
                                <option value="{{ $p->id }}" {{ old('pegawai_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_dengan_gelar }}</option>
                                @endforeach
                            </select>
                            @error('pegawai_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sertifikat -->
                        <div class="mb-3">
                            <label for="jenis_sertifikat" class="form-label">Jenis Sertifikat</label>
                            <select class="form-control @error('jenis_sertifikat') is-invalid @enderror" id="jenis_sertifikat" name="jenis_sertifikat">
                                <option value="">-- Pilih Sertifikat --</option>
                                <option value="STR" {{ old('jenis_sertifikat') == 'STR' ? 'selected' : '' }}>STR</option>
                                <option value="SIP" {{ old('jenis_sertifikat') == 'SIP' ? 'selected' : '' }}>SIP</option>
                            </select>
                            @error('jenis_sertifikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor -->
                        <div class="mb-3">
                            <label for="nomor" class="form-label">Nomor</label>
                            <input type="text" class="form-control @error('nomor') is-invalid @enderror" id="nomor" name="nomor" value="{{ old('nomor') }}">
                            @error('nomor')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Terbit -->
                        <div class="mb-3">
                            <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                            <input type="date" class="form-control @error('tgl_terbit') is-invalid @enderror" id="tgl_terbit" name="tgl_terbit" value="{{ old('tgl_terbit') }}">
                            @error('tgl_terbit')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Kadaluarsa -->
                        <div class="mb-3">
                            <label for="tgl_kadaluarsa" class="form-label">Tanggal Kadaluarsa</label>
                            <input type="date" class="form-control @error('tgl_kadaluarsa') is-invalid @enderror" id="tgl_kadaluarsa" name="tgl_kadaluarsa" value="{{ old('tgl_kadaluarsa') }}">
                            @error('tgl_kadaluarsa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Upload File Sertifikat -->
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload File Sertifikat</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror"
                                id="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.webp">
                            @error('file')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('sertifikat-pegawai.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>


                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
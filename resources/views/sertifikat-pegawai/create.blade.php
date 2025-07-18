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
                <form action="{{ route('sertifikat-pegawai.store') }}" method="POST">
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
                            <label for="sertifikat" class="form-label">Tingkat Sertifikat</label>
                            <select class="form-control @error('sertifikat') is-invalid @enderror" id="sertifikat" name="sertifikat">
                                <option value="">-- Pilih Sertifikat --</option>
                                <option value="SD" {{ old('sertifikat') == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ old('sertifikat') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/SMK" {{ old('sertifikat') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                <option value="D3" {{ old('sertifikat') == 'D3' ? 'selected' : '' }}>D3</option>
                                <option value="S1" {{ old('sertifikat') == 'S1' ? 'selected' : '' }}>S1</option>
                                <option value="S2" {{ old('sertifikat') == 'S2' ? 'selected' : '' }}>S2</option>
                                <option value="S3" {{ old('sertifikat') == 'S3' ? 'selected' : '' }}>S3</option>
                            </select>
                            @error('sertifikat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nama Sekolah -->
                        <div class="mb-3">
                            <label for="nama_sekolah" class="form-label">Nama Sekolah</label>
                            <input type="text" class="form-control @error('nama_sekolah') is-invalid @enderror" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah') }}">
                            @error('nama_sekolah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jurusan -->
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <input type="text" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" value="{{ old('jurusan') }}">
                            @error('jurusan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Nomor Ijazah -->
                        <div class="mb-3">
                            <label for="nomor_ijazah" class="form-label">Nomor Ijazah</label>
                            <input type="text" class="form-control @error('nomor_ijazah') is-invalid @enderror" id="nomor_ijazah" name="nomor_ijazah" value="{{ old('nomor_ijazah') }}">
                            @error('nomor_ijazah')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tahun Lulus -->
                        <div class="mb-3">
                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                            <input type="number" class="form-control @error('tahun_lulus') is-invalid @enderror" id="tahun_lulus" name="tahun_lulus" value="{{ old('tahun_lulus') }}" min="1900" max="{{ date('Y') }}">
                            @error('tahun_lulus')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ route('sertifikat-pegawai.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>


                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
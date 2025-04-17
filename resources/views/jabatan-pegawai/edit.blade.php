@extends('layouts.app')

@section('content_body')
<div class="container">
    <!-- <div class="text-start">
        <h2>Input Data</h2>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-md-8 mt-4">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title">Edit Data Pegawai</h3>
                    <div class="card-tools">
                        <!-- Buttons, labels, and many other things can be placed here! -->
                        <!-- Here is a label for example -->
                        <!-- <span class="badge badge-primary">Label</span> -->
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <form action="{{ route('jabatan-pegawai.update', $jabatan->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Pegawai -->
                        <div class="mb-3">
                            <label for="pegawai_id" class="form-label">Pegawai</label>
                            <select class="form-control @error('pegawai_id') is-invalid @enderror" id="pegawai_id" name="pegawai_id">
                                <option value="">-- Pilih Pegawai --</option>
                                @foreach($pegawais as $p)
                                <option value="{{ $p->id }}" {{ old('pegawai_id', $jabatan->pegawai_id) == $p->id ? 'selected' : '' }}>{{ $p->nama_dengan_gelar }}</option>
                                @endforeach
                            </select>
                            @error('pegawai_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Bidang -->
                        <div class="mb-3">
                            <label for="bidang" class="form-label">Bidang</label>
                            <input type="text" class="form-control @error('bidang') is-invalid @enderror" id="bidang" name="bidang" value="{{ old('bidang', $jabatan->bidang) }}">
                            @error('bidang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ruangan -->
                        <div class="mb-3">
                            <label for="ruangan" class="form-label">Ruangan</label>
                            <input type="text" class="form-control @error('ruangan') is-invalid @enderror" id="ruangan" name="ruangan" value="{{ old('ruangan', $jabatan->ruangan) }}">
                            @error('ruangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan</label>
                            <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" value="{{ old('jabatan', $jabatan->jabatan) }}">
                            @error('jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Jenjang Jabatan -->
                        <div class="mb-3">
                            <label for="jenjang_jabatan" class="form-label">Jenjang Jabatan</label>
                            <input type="text" class="form-control @error('jenjang_jabatan') is-invalid @enderror" id="jenjang_jabatan" name="jenjang_jabatan" value="{{ old('jenjang_jabatan', $jabatan->jenjang_jabatan) }}">
                            @error('jenjang_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Golongan Pangkat -->
                        <div class="mb-3">
                            <label for="golongan_pangkat" class="form-label">Golongan Pangkat</label>
                            <input type="text" class="form-control @error('golongan_pangkat') is-invalid @enderror" id="golongan_pangkat" name="golongan_pangkat" value="{{ old('golongan_pangkat', $jabatan->golongan_pangkat) }}">
                            @error('golongan_pangkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- TMT Jabatan -->
                        <div class="mb-3">
                            <label for="tmt_jabatan" class="form-label">TMT Jabatan</label>
                            <input type="date" class="form-control @error('tmt_jabatan') is-invalid @enderror" id="tmt_jabatan" name="tmt_jabatan" value="{{ old('tmt_jabatan', $jabatan->tmt_jabatan) }}">
                            @error('tmt_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status Jabatan -->
                        <div class="mb-3">
                            <label for="status_jabatan" class="form-label">Status Jabatan</label>
                            <select class="form-control @error('status_jabatan') is-invalid @enderror" id="status_jabatan" name="status_jabatan">
                                <option value="">-- Pilih Status --</option>
                                <option value="utama" {{ old('status_jabatan', $jabatan->status_jabatan) == 'utama' ? 'selected' : '' }}>Utama</option>
                                <option value="tambahan" {{ old('status_jabatan', $jabatan->status_jabatan) == 'tambahan' ? 'selected' : '' }}>Tambahan</option>
                            </select>
                            @error('status_jabatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <a href="{{ url('pegawai/' . $jabatan->pegawai_id) }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
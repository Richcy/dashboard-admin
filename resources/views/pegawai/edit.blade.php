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
                <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <!-- Nama dengan Gelar -->
                        <div class="mb-3">
                            <label for="nama_dengan_gelar" class="form-label">Nama dengan Gelar</label>
                            <input type="text" class="form-control @error('nama_dengan_gelar') is-invalid @enderror" id="nama_dengan_gelar" name="nama_dengan_gelar" value="{{ old('nama_dengan_gelar', $pegawai->nama_dengan_gelar) }}">
                            @error('nama_dengan_gelar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nama tanpa Gelar -->
                        <div class="mb-3">
                            <label for="nama_tanpa_gelar" class="form-label">Nama Tanpa Gelar</label>
                            <input type="text" class="form-control @error('nama_tanpa_gelar') is-invalid @enderror" id="nama_tanpa_gelar" name="nama_tanpa_gelar" value="{{ old('nama_tanpa_gelar', $pegawai->nama_tanpa_gelar) }}">
                            @error('nama_tanpa_gelar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- NIK -->
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $pegawai->nik) }}">
                            @error('nik') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
                                @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                    id="tanggal_lahir" name="tanggal_lahir"
                                    value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($pegawai->tanggal_lahir)->format('Y-m-d')) }}">
                                @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- NIP/NPP & TMT Kerja -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nip_npp" class="form-label">NIP/NPP</label>
                                <input type="text" class="form-control @error('nip_npp') is-invalid @enderror" id="nip_npp" name="nip_npp" value="{{ old('nip_npp', $pegawai->nip_npp) }}">
                                @error('nip_npp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tmt_kerja" class="form-label">TMT Kerja</label>
                                <input type="date" class="form-control @error('tmt_kerja') is-invalid @enderror"
                                    id="tmt_kerja" name="tmt_kerja"
                                    value="{{ old('tmt_kerja', \Carbon\Carbon::parse($pegawai->tmt_kerja)->format('Y-m-d')) }}">

                                @error('tmt_kerja') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Status ASN & TMT ASN -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status_asn" class="form-label">Status Pegawai</label>
                                <select class="form-control @error('status_asn') is-invalid @enderror" id="status_asn" name="status_asn">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="PNS" {{ old('status_asn', $pegawai->status_asn) == 'PNS' ? 'selected' : '' }}>PNS</option>
                                    <option value="PPPK" {{ old('status_asn', $pegawai->status_asn) == 'PPPK' ? 'selected' : '' }}>PPPK</option>
                                    <option value="Kontrak BLUD" {{ old('status_asn', $pegawai->status_asn) == 'Kontrak BLUD' ? 'selected' : '' }}>Kontrak BLUD</option>
                                </select>
                                @error('status_asn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tmt_asn" class="form-label">TMT ASN</label>
                                <input type="date" class="form-control @error('tmt_asn') is-invalid @enderror"
                                    id="tmt_asn" name="tmt_asn"
                                    value="{{ old('tmt_asn', \Carbon\Carbon::parse($pegawai->tmt_asn)->format('Y-m-d')) }}">
                                @error('tmt_asn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Status Perkawinan & Tanggungan -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status_perkawinan" class="form-label">Status Perkawinan</label>
                                <select class="form-control @error('status_perkawinan') is-invalid @enderror" id="status_perkawinan" name="status_perkawinan">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $pegawai->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggungan" class="form-label">Jumlah Tanggungan</label>
                                <input type="number" class="form-control @error('tanggungan') is-invalid @enderror" id="tanggungan" name="tanggungan" value="{{ old('tanggungan', $pegawai->tanggungan) }}">
                                @error('tanggungan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2">{{ old('alamat', $pegawai->alamat) }}</textarea>
                            @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- RT & RW -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="rt" class="form-label">RT</label>
                                <input type="text" class="form-control @error('rt') is-invalid @enderror" id="rt" name="rt" value="{{ old('rt', $pegawai->rt) }}">
                                @error('rt') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="rw" class="form-label">RW</label>
                                <input type="text" class="form-control @error('rw') is-invalid @enderror" id="rw" name="rw" value="{{ old('rw', $pegawai->rw) }}">
                                @error('rw') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Kelurahan/Desa & Kecamatan -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kelurahan_desa" class="form-label">Kelurahan/Desa</label>
                                <input type="text" class="form-control @error('kelurahan_desa') is-invalid @enderror" id="kelurahan_desa" name="kelurahan_desa" value="{{ old('kelurahan_desa', $pegawai->kelurahan_desa) }}">
                                @error('kelurahan_desa') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kecamatan" class="form-label">Kecamatan</label>
                                <input type="text" class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan" name="kecamatan" value="{{ old('kecamatan', $pegawai->kecamatan) }}">
                                @error('kecamatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Kota/Kabupaten & Provinsi -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kota_kabupaten" class="form-label">Kota/Kabupaten</label>
                                <input type="text" class="form-control @error('kota_kabupaten') is-invalid @enderror" id="kota_kabupaten" name="kota_kabupaten" value="{{ old('kota_kabupaten', $pegawai->kota_kabupaten) }}">
                                @error('kota_kabupaten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="provinsi" class="form-label">Provinsi</label>
                                <input type="text" class="form-control @error('provinsi') is-invalid @enderror" id="provinsi" name="provinsi" value="{{ old('provinsi', $pegawai->provinsi) }}">
                                @error('provinsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- Bank & Nomor Rekening -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="bank" class="form-label">Bank</label>
                                <input type="text" class="form-control @error('bank') is-invalid @enderror" id="bank" name="bank" value="{{ old('bank', $pegawai->bank) }}">
                                @error('bank') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="nomor_rekening" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control @error('nomor_rekening') is-invalid @enderror" id="nomor_rekening" name="nomor_rekening" value="{{ old('nomor_rekening', $pegawai->nomor_rekening) }}">
                                @error('nomor_rekening') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <!-- NPWP -->
                        <div class="mb-3">
                            <label for="npwp" class="form-label">NPWP</label>
                            <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp" value="{{ old('npwp', $pegawai->npwp) }}">
                            @error('npwp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <!-- Nomor Telepon & Email -->
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nomor_telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" class="form-control @error('nomor_telepon') is-invalid @enderror" id="nomor_telepon" name="nomor_telepon" value="{{ old('nomor_telepon', $pegawai->nomor_telepon) }}">
                                @error('nomor_telepon') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $pegawai->email) }}">
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="status_pegawai" class="form-label">Status Pegawai</label>
                            <select class="form-control @error('status_pegawai') is-invalid @enderror" id="status_pegawai" name="status_pegawai">
                                <option value="">-- Pilih Status --</option>
                                <option value="aktif" {{ old('status_pegawai', $pegawai->status_pegawai) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="resign" {{ old('status_pegawai', $pegawai->status_pegawai) == 'resign' ? 'selected' : '' }}>Resign</option>
                            </select>
                            @error('status_pegawai')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <a href="{{ $pegawai->status_pegawai === 'resign' ? route('pegawai.nonaktif') : route('pegawai.aktif') }}" class="btn btn-secondary mr-2">Back</a>
                        <button type="submit" class="btn btn-warning">Update</button>
                    </div>
                </form>


                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
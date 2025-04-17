    @extends('layouts.app')

    @section('content_body')
    <div class="container">
        <div class="text-start mb-3">
            <h2>Detail Pegawai</h2>
            <a href="{{ $backUrl }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="pegawaiTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="informasi-tab" data-toggle="tab" href="#informasi" role="tab">Informasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pendidikan-tab" data-toggle="tab" href="#pendidikan" role="tab">Pendidikan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="jabatan-tab" data-toggle="tab" href="#jabatan" role="tab">Jabatan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div>
                            <h3>Informasi Pegawai</h3>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th>Nama dengan Gelar</th>
                                <td>{{ $pegawai->nama_dengan_gelar }}</td>
                            </tr>
                            <tr>
                                <th>Nama Tanpa Gelar</th>
                                <td>{{ $pegawai->nama_tanpa_gelar }}</td>
                            </tr>
                            <tr>
                                <th>NIK</th>
                                <td>{{ $pegawai->nik }}</td>
                            </tr>
                            <tr>
                                <th>NIP/NPP</th>
                                <td>{{ $pegawai->nip_npp }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Lahir</th>
                                <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th>TMT Kerja</th>
                                <td>{{ \Carbon\Carbon::parse($pegawai->tmt_kerja)->translatedFormat('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status ASN</th>
                                <td>{{ $pegawai->status_asn }}</td>
                            </tr>
                            <tr>
                                <th>TMT ASN</th>
                                <td>{{ \Carbon\Carbon::parse($pegawai->tmt_asn)->translatedFormat('j F Y') }}</td>
                            </tr>
                            <tr>
                                <th>Status Perkawinan</th>
                                <td>{{ $pegawai->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tanggungan</th>
                                <td>{{ $pegawai->tanggungan }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $pegawai->alamat }}</td>
                            </tr>
                            <tr>
                                <th>RT / RW</th>
                                <td>{{ $pegawai->rt }} / {{ $pegawai->rw }}</td>
                            </tr>
                            <tr>
                                <th>Kelurahan/Desa</th>
                                <td>{{ $pegawai->kelurahan_desa }}</td>
                            </tr>
                            <tr>
                                <th>Kecamatan</th>
                                <td>{{ $pegawai->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th>Kota/Kabupaten</th>
                                <td>{{ $pegawai->kota_kabupaten }}</td>
                            </tr>
                            <tr>
                                <th>Provinsi</th>
                                <td>{{ $pegawai->provinsi }}</td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>{{ $pegawai->bank }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Rekening</th>
                                <td>{{ $pegawai->nomor_rekening }}</td>
                            </tr>
                            <tr>
                                <th>NPWP</th>
                                <td>{{ $pegawai->npwp }}</td>
                            </tr>
                            <tr>
                                <th>Nomor Telepon</th>
                                <td>{{ $pegawai->nomor_telepon }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $pegawai->email }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
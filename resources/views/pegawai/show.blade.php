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
                            <li class="nav-item">
                                <a class="nav-link" id="sertifikat-tab" data-toggle="tab" href="#sertifikat" role="tab">Sertifikat</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content mt-3" id="pegawaiTabContent">
                            <div class="tab-pane fade show active" id="informasi" role="tabpanel" aria-labelledby="informasi-tab">
                                <div>
                                    <h3>Informasi Pegawai</h3>
                                </div>
                                <div class="mb-3 position-relative d-inline-block">
                                    @php
                                    $foto = $pegawai->documents()->where('jenis_dokumen', 'foto')->first();
                                    $fotoPath = $foto ? asset('storage/' . $foto->path) : asset('images/default.png');
                                    @endphp

                                    <!-- Clickable image as modal trigger -->
                                    <button type="button" class="border-0 p-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#changeFotoModal">
                                        <img id="fotoPreviewDisplay" src="{{ $fotoPath }}" class="img-thumbnail" width="400" style="cursor: pointer;">

                                    </button>
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
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $pegawai->jenis_kelamin }}</td>
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
                                        <th>Tempat Lahir</th>
                                        <td>{{ $pegawai->tempat_lahir }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Lahir</th>
                                        <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_lahir)->translatedFormat('j F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Umur</th>
                                        <td>{{ $pegawai->umur }}</td>
                                    </tr>
                                    <tr>
                                        <th>TMT Kerja</th>
                                        <td>{{ \Carbon\Carbon::parse($pegawai->tmt_kerja)->translatedFormat('j F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Tenaga</th>
                                        <td>{{ $pegawai->jenis_tenaga_label }}</td>
                                    </tr>
                                    <tr>
                                        <th>Posisi Jabatan</th>
                                        <td>{{ $pegawai->posisi_jabatan_label }}</td>
                                    </tr>
                                    <tr>
                                        <th>Masa Kerja</th>
                                        <td>{{ $pegawai->masaKerja }}</td>
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
                                    <tr>
                                        <th>Status Pegawai</th>
                                        <td>{{ $pegawai->status_pegawai }}</td>
                                    </tr>
                                </table>
                                <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning">Edit Pegawai</a>
                            </div>

                            <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="pendidikan-tab">
                                <div>
                                    <h3>Pendidikan Pegawai</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="pendidikan-table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>Tingkat Pendidikan</th>
                                                <th>Nama Sekolah</th>
                                                <th>Jurusan</th>
                                                <th>Nomor Ijazah</th>
                                                <th>Tahun Lulus</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pegawai->pendidikan as $index => $p)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $pegawai->nama_dengan_gelar }}</td>
                                                <td>{{ $p->pendidikan }}</td>
                                                <td>{{ $p->nama_sekolah }}</td>
                                                <td>{{ $p->jurusan }}</td>
                                                <td>{{ $p->nomor_ijazah }}</td>
                                                <td>{{ $p->tahun_lulus }}</td>
                                                <td>
                                                    <a href="{{ route('pendidikan-pegawai.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('pendidikan-pegawai.destroy', $p->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Belum ada data pendidikan</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab">
                                <div>
                                    <h3>Jabatan Pegawai</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>Bidang</th>
                                                <th>Ruangan</th>
                                                <th>Jabatan</th>
                                                <th>Jenjang Jabatan</th>
                                                <th>Golongan Pangkat</th>
                                                <th>TMT Jabatan</th>
                                                <th>Status Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pegawai->jabatan as $index => $j)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $pegawai->nama_dengan_gelar }}</td>
                                                <td>{{ $j->bidang }}</td>
                                                <td>{{ $j->ruangan }}</td>
                                                <td>{{ $j->jabatan }}</td>
                                                <td>{{ $j->jenjang_jabatan }}</td>
                                                <td>{{ $j->golongan_pangkat }}</td>
                                                <td>{{ \Carbon\Carbon::parse($j->tmt_jabatan)->translatedFormat('d F Y') }}</td>
                                                <td>{{ ucfirst($j->status_jabatan) }}</td>
                                                <td>
                                                    <a href="{{ route('jabatan-pegawai.edit', $j->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('jabatan-pegawai.destroy', $j->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="10" class="text-center">Belum ada data jabatan.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sertifikat" role="tabpanel" aria-labelledby="sertifikat-tab">
                                <div>
                                    <h3>Sertifikat Pegawai</h3>
                                </div>
                                <div class="table-responsive">
                                    <table id="sertifikat-table" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pegawai</th>
                                                <th>Jenis Sertifikat</th>
                                                <th>Nomor</th>
                                                <th>Tanggal Terbit</th>
                                                <th>Tanggal Kadaluarsa</th>
                                                <th>File</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($pegawai->sertifikat as $index => $p)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $pegawai->nama_dengan_gelar }}</td>
                                                <td>{{ $p->jenis_sertifikat }}</td>
                                                <td>{{ $p->nomor }}</td>
                                                <td>{{ $p->tgl_terbit ? \Carbon\Carbon::parse($p->tgl_terbit)->translatedFormat('j F Y') : '-' }}</td>
                                                <td>{{ $p->tgl_kadaluarsa ? \Carbon\Carbon::parse($p->tgl_kadaluarsa)->translatedFormat('j F Y') : '-' }}</td>
                                                {{-- Kolom File --}}
                                                <td>
                                                    @if ($p->document && $p->document->path)
                                                    @php
                                                    $ext = pathinfo($p->document->path, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if(in_array($ext, ['jpg', 'jpeg', 'png', 'webp']))
                                                    <img src="{{ asset('storage/' . $p->document->path) }}" alt="File Sertifikat" width="60">
                                                    @else
                                                    <a href="{{ asset('storage/' . $p->document->path) }}" target="_blank">Lihat File</a>
                                                    @endif
                                                    @else
                                                    <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('sertifikat-pegawai.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                    <form action="{{ route('sertifikat-pegawai.destroy', $p->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus data?')">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="text-center">Belum ada data sertifikat</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Content -->
    <div class="modal fade" id="changeFotoModal" tabindex="-1" aria-labelledby="changeFotoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('pegawai.update-foto', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changeFotoModalLabel">Ganti Foto Pegawai</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="fotoPreviewModal" src="{{ $fotoPath }}" class="img-thumbnail mb-3" width="400">
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" onchange="previewFoto(this)">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @endsection

    @section('js')
    <script>
        function previewFoto(input) {
            const previewModal = document.getElementById('fotoPreviewModal');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewModal.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    @endsection
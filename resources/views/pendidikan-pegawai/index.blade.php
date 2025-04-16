@extends('layouts.app')

@push('css')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="container">
    <!-- <div class="text-start">
        <h2>All Data</h2>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Tabel Pendidikan Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <a href="{{ route('pendidikan-pegawai.create') }}" class="btn btn-primary">Tambah Data</a>
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
                                    <!-- <th>Aksi</th> -->
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#pendidikan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pendidikan-pegawai.data') }}", // Adjust this route to match your controller
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'pegawai.nama_dengan_gelar',
                    name: 'pegawai.nama_dengan_gelar'
                },
                {
                    data: 'pendidikan',
                    name: 'pendidikan'
                },
                {
                    data: 'nama_sekolah',
                    name: 'nama_sekolah'
                },
                {
                    data: 'jurusan',
                    name: 'jurusan'
                },
                {
                    data: 'nomor_ijazah',
                    name: 'nomor_ijazah'
                },
                {
                    data: 'tahun_lulus',
                    name: 'tahun_lulus'
                },
                // {
                //     data: 'action',
                //     name: 'action',
                //     orderable: false,
                //     searchable: false
                // }
            ]
        });
    });
</script>
@endpush
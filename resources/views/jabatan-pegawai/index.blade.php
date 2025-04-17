@extends('layouts.app')

@push('css')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content_body')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Tabel Jabatan Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <a href="{{ route('jabatan-pegawai.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="table-responsive">
                        <table id="jabatan-table" class="table table-bordered">
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
        $('#jabatan-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('jabatan-pegawai.data') }}", // Make sure this route exists in your web.php
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
                    data: 'bidang',
                    name: 'bidang'
                },
                {
                    data: 'ruangan',
                    name: 'ruangan'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },
                {
                    data: 'jenjang_jabatan',
                    name: 'jenjang_jabatan'
                },
                {
                    data: 'golongan_pangkat',
                    name: 'golongan_pangkat'
                },
                {
                    data: 'tmt_jabatan',
                    name: 'tmt_jabatan'
                },
                {
                    data: 'status_jabatan',
                    name: 'status_jabatan'
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
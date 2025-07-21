@extends('layouts.app')

@push('css')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
@endpush

@section('content_body')
<div class="container">
    <!-- <div class="text-start">
        <h2>All Data</h2>
    </div> -->
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Tabel Sertifikat Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <a href="{{ route('sertifikat-pegawai.create') }}" class="btn btn-primary">Tambah Data</a>
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
        $('#sertifikat-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('sertifikat-pegawai.data') }}", // Adjust this route to match your controller
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
                    data: 'jenis_sertifikat',
                    name: 'jenis_sertifikat'
                },
                {
                    data: 'nomor',
                    name: 'nomor'
                },
                {
                    data: 'tgl_terbit',
                    name: 'tgl_terbit'
                },
                {
                    data: 'tgl_kadaluarsa',
                    name: 'tgl_kadaluarsa'
                },
                {
                    data: 'file',
                    name: 'file',
                    orderable: false,
                    searchable: false
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
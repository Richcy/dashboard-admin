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
                    <h3 class="card-title">Tabel Pegawai</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row mb-3">
                        <a href="{{ route('pegawai.create') }}" class="btn btn-primary">Tambah Data</a>
                        <a href="{{ route('pegawai.export') }}" class="btn btn-success ml-2">📥 Download Excel</a>
                    </div>
                    <form action="{{ route('pegawai.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Import Pegawai (Excel)</label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <button class="btn btn-success">Import</button>
                    </form>
                    <div class="table-responsive">
                        <table id="pegawai-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>NIP</th>
                                    <th>Status ASN</th>
                                    <th>Nomor HP</th>
                                    <th>Status Pegawai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
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
        $('#pegawai-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pegawai.data", $status) }}',
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama_dengan_gelar',
                    name: 'nama_dengan_gelar'
                },
                {
                    data: 'nip_npp',
                    name: 'nip_npp'
                },
                {
                    data: 'status_asn',
                    name: 'status_asn'
                },
                {
                    data: 'nomor_telepon',
                    name: 'nomor_telepon'
                },
                {
                    data: 'status_pegawai',
                    name: 'status_pegawai'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
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
                    <h3 class="card-title">Tabel Riwayat Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="riwayat-table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Riwayat</th>
                                    <th>Tanggal Perubahan</th>
                                    <th>Keterangan</th>
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
    $('#riwayat-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('riwayat-pegawai.data') }}", // make sure this matches your route
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },
            {
                data: 'pegawai_nama',
                name: 'pegawai.nama_dengan_gelar'
            },
            {
                data: 'riwayat',
                name: 'riwayat',
                orderable: false,
                searchable: false
            },
            {
                data: 'tanggal',
                name: 'tanggal_perubahan'
            },
            {
                data: 'keterangan',
                name: 'keterangan'
            }
        ]
    });
</script>
@endpush
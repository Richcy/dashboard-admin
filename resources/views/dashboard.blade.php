@extends('layouts.app')

@section('content_body')
<div class="container">
    <div class="row">
        <h1 class="mt-1">Dashboard</h1>
    </div>

    <div class="row">

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Total Pegawai" text="{{ $pegawaiCount }}" icon="fas fa-users" theme="primary" />
        </div>

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Pegawai Aktif" text="{{ $aktifCount }}" icon="fas fa-user" theme="success" />
        </div>

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Pegawai Non Aktif" text="{{ $nonAktifCount }}" icon="fas fa-user-slash" theme="warning" />
        </div>
    </div>

    <div class="row">

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Total Jabatan Pegawai" text="{{ $jabatanPegawaiCount }}" icon="fas fa-users" theme="primary" />
        </div>

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Jabatan Utama" text="{{ $utamaCount }}" icon="fas fa-user" theme="success" />
        </div>

        <div class="col-md-4 mt-3">
            <x-adminlte-info-box title="Jabatan Tambahan" text="{{ $tambahanCount }}" icon="fas fa-user-slash" theme="warning" />
        </div>
    </div>

    <div class="row">

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="Total Pegawai Aktif" text="{{ $aktifCount }}" icon="fas fa-users" theme="primary" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="PNS (Aktif)" text="{{ $pnsAktifCount }}" icon="fas fa-user-tie" theme="success" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="PPPK (Aktif)" text="{{ $pppkAktifCount }}" icon="fas fa-user-tag" theme="warning" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="Kontrak BLUD (Aktif)" text="{{ $kontrakAktifCount }}" icon="fas fa-user-clock" theme="info" />
        </div>
    </div>

    <div class="row">

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="Total Pegawai Non Aktif" text="{{ $nonAktifCount }}" icon="fas fa-users-slash" theme="primary" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="PNS (Non Aktif)" text="{{ $pnsNonAktifCount }}" icon="fas fa-user-tie" theme="success" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="PPPK (Non Aktif)" text="{{ $pppkNonAktifCount }}" icon="fas fa-user-tag" theme="warning" />
        </div>

        <div class="col-md-3 mt-3">
            <x-adminlte-info-box title="Kontrak BLUD (Non Aktif)" text="{{ $kontrakNonAktifCount }}" icon="fas fa-user-clock" theme="info" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Pegawai</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body" id="chartWrapper" style="height: 40vh;"
                    data-labels='@json($chartData["labels"])'
                    data-values='@json($chartData["data"])'
                    data-background-color='@json($chartData["backgroundColor"])'>
                    <canvas id="pegawaiChart"></canvas>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card card-success">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Jabatan Pegawai</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body" id="chartWrapper2" style="height: 40vh;"
                    data-labels='@json($chartData2["labels"])'
                    data-values='@json($chartData2["data"])'
                    data-background-color='@json($chartData2["backgroundColor"])'>
                    <canvas id="jabatanChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Jabatan Utama Pegawai</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body" id="jabatanUtamaWrapper" style="height: 40vh;"
                    data-labels='@json($jabatanChartLabels)'
                    data-values='@json($jabatanChartData)'>
                    <canvas id="jabatanUtamaChart"></canvas>
                </div>

            </div>
        </div>
    </div>



</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@vite('resources/js/dashboard.js')
@endsection
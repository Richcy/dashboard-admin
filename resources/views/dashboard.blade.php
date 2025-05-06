@extends('layouts.app')

@section('content_body')
<div class="container">
    <div class="row">
        <h1 class="mt-1">Dashboard</h1>
    </div>

    <!-- <div class="row">

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
    </div> -->

    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Jumlah Pegawai Aktif</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="margin: auto;">
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
                </div>
            </div>
        </div>

        <!-- <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Jumlah Pegawai Non Aktif</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="margin: auto;">
                        <div class="col-md-12 mt-3">
                            <x-adminlte-info-box title="Total Pegawai Non Aktif" text="{{ $nonAktifCount }}" icon="fas fa-users-slash" theme="primary" />
                        </div>

                        <div class="col-md-12 mt-3">
                            <x-adminlte-info-box title="PNS (Non Aktif)" text="{{ $pnsNonAktifCount }}" icon="fas fa-user-tie" theme="success" />
                        </div>

                        <div class="col-md-12 mt-3">
                            <x-adminlte-info-box title="PPPK (Non Aktif)" text="{{ $pppkNonAktifCount }}" icon="fas fa-user-tag" theme="warning" />
                        </div>

                        <div class="col-md-12 mt-3">
                            <x-adminlte-info-box title="Kontrak BLUD (Non Aktif)" text="{{ $kontrakNonAktifCount }}" icon="fas fa-user-clock" theme="info" />
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>

    <!-- <div class="row">

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
    </div> -->

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Pendidikan Pegawai</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="margin: auto;">
                        @php
                        // Optional: You can assign icons and themes based on degree if needed
                        $degreeStyles = [
                        'SD' => ['icon' => 'fas fa-school', 'theme' => 'secondary'],
                        'SMP' => ['icon' => 'fas fa-university', 'theme' => 'primary'],
                        'SMA' => ['icon' => 'fas fa-graduation-cap', 'theme' => 'info'],
                        'D3' => ['icon' => 'fas fa-user-graduate', 'theme' => 'warning'],
                        'S1' => ['icon' => 'fas fa-user-graduate', 'theme' => 'success'],
                        'S2' => ['icon' => 'fas fa-chalkboard-teacher', 'theme' => 'danger'],
                        'S3' => ['icon' => 'fas fa-award', 'theme' => 'dark'],
                        ];
                        @endphp

                        @foreach (['SD', 'SMP', 'SMA', 'D3', 'S1', 'S2', 'S3'] as $degree)
                        <div class="col-md-6 mt-3">
                            <x-adminlte-info-box
                                title="Pendidikan {{ $degree }}"
                                text="{{ $degreeCount[$degree] ?? 0 }}"
                                icon="{{ $degreeStyles[$degree]['icon'] }}"
                                theme="{{ $degreeStyles[$degree]['theme'] }}" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Jabatan Pegawai</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="margin: auto;">
                        @foreach ($jabatanInfoBoxes as $box)
                        <div class="col-md-6 mt-3">
                            <x-adminlte-info-box
                                title="{{ $box['title'] }}"
                                text="{{ $box['total'] }}"
                                icon="{{ $box['icon'] }}"
                                theme="{{ $box['theme'] }}" />
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        @foreach ($jabatanInfoBoxes as $box)
        <div class="col-md-6 mt-3">
            <x-adminlte-info-box
                title="{{ $box['title'] }}"
                text="{{ $box['total'] }}"
                icon="{{ $box['icon'] }}"
                theme="{{ $box['theme'] }}" />
        </div>
        @endforeach
    </div> -->

    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Pegawai Aktif</h5>
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
                    data-labels='@json($chartData3["labels"])'
                    data-values='@json($chartData3["data"])'
                    data-background-color='@json($chartData3["backgroundColor"])'>
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
                    <h5 class="card-title">Visualisasi Jabatan Utama Pegawai (Aktif)</h5>
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
        <div class="col-md-6 mt-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Jenis Tenaga (Aktif)</h5>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button> -->
                    </div>
                </div>
                <div class="card-body" id="jenisTenagaKerjaWrapper" style="height: 40vh;"
                    data-labels='@json($chartJenisTenagaData["labels"])'
                    data-values='@json($chartJenisTenagaData["data"])'
                    data-background-color='@json($chartJenisTenagaData["backgroundColor"])'>
                    <canvas id="chartJenisTenagaData"></canvas>
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
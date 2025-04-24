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
        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Pegawai</h5>
                </div>
                <div class="card-body" id="chartWrapper"
                    data-labels='@json($chartData["labels"])'
                    data-values='@json($chartData["data"])'
                    data-background-color='@json($chartData["backgroundColor"])'>
                    <canvas id="pegawaiChart"></canvas>
                </div>

            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Visualisasi Data Jabatan Pegawai</h5>
                </div>
                <div class="card-body" id="chartWrapper2"
                    data-labels='@json($chartData2["labels"])'
                    data-values='@json($chartData2["data"])'
                    data-background-color='@json($chartData2["backgroundColor"])'>
                    <canvas id="jabatanChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart for Status Pegawai (Employee Status)
    const chartElement = document.getElementById('chartWrapper');
    const chartLabels = JSON.parse(chartElement.dataset.labels);
    const chartData = JSON.parse(chartElement.dataset.values);
    const chartBackgroundColor = JSON.parse(chartElement.dataset.backgroundColor);

    const ctx = document.getElementById('pegawaiChart').getContext('2d');
    const pegawaiChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Status Pegawai',
                data: chartData,
                backgroundColor: chartBackgroundColor,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Chart for Status Jabatan Pegawai (Position Status)
    const chartElement2 = document.getElementById('chartWrapper2');
    const chartLabels2 = JSON.parse(chartElement2.dataset.labels);
    const chartData2 = JSON.parse(chartElement2.dataset.values);
    const chartBackgroundColor2 = JSON.parse(chartElement2.dataset.backgroundColor);

    const ctx2 = document.getElementById('jabatanChart').getContext('2d');
    const jabatanChart = new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: chartLabels2,
            datasets: [{
                label: 'Status Jabatan Pegawai',
                data: chartData2,
                backgroundColor: chartBackgroundColor2,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            aspectRatio: 2,
        }
    });
</script>
@endsection
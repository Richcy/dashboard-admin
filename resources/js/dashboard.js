// Chart for Status Pegawai (Employee Status)
const chartElement = document.getElementById('chartWrapper');
const chartLabels = JSON.parse(chartElement.dataset.labels);
const chartData = JSON.parse(chartElement.dataset.values);
const chartBackgroundColor = JSON.parse(chartElement.dataset.backgroundColor);

const ctx = document.getElementById('pegawaiChart').getContext('2d');
const pegawaiChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [''], // use empty string so bars don’t group by label
        datasets: chartLabels.map((label, index) => ({
            label: label,
            data: [chartData[index]],
            backgroundColor: chartBackgroundColor[index],
            borderWidth: 1
        }))
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom' // moves legend below the chart
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            },
            x: {
                display: false // hide x-axis since we’re using one category
            }
        }
    }
});

// Chart for Status Jabatan Pegawai (Position Status)
const chartElement2 = document.getElementById('chartWrapper2');
const chartLabels2 = JSON.parse(chartElement2.dataset.labels);
const chartData2 = JSON.parse(chartElement2.dataset.values);
const chartBackgroundColor2 = JSON.parse(chartElement2.dataset.backgroundColor);

console.log("Labels: ", document.getElementById('chartWrapper2')?.dataset.labels);
console.log("Values: ", document.getElementById('chartWrapper2')?.dataset.values);

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
        //aspectRatio: 2,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return `${context.label}: ${context.parsed}`;
                    }
                }
            }
        }
    }
});

const chartElementJabatanUtama = document.getElementById('jabatanUtamaWrapper');
const jabatanChartLabels = JSON.parse(chartElementJabatanUtama.dataset.labels);
const jabatanChartData = JSON.parse(chartElementJabatanUtama.dataset.values);

console.log("Labels: ", document.getElementById('jabatanUtamaWrapper')?.dataset.labels);
console.log("Values: ", document.getElementById('jabatanUtamaWrapper')?.dataset.values);

const ctx3 = document.getElementById('jabatanUtamaChart').getContext('2d');
const jabatanUtamaChart = new Chart(ctx3, {
    type: 'doughnut',
    data: {
        labels: jabatanChartLabels,
        datasets: [{
            label: 'Jabatan Utama',
            data: jabatanChartData,
            //backgroundColor: jabatanChartColors,
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function (context) {
                        return `${context.label}: ${context.parsed}`;
                    }
                }
            }
        }
    }
});

// Chart for Status Pegawai (Employee Status)
const chartElement = document.getElementById('chartWrapper');
const chartLabels = JSON.parse(chartElement.dataset.labels);
const chartData = JSON.parse(chartElement.dataset.values);
const chartBackgroundColor = JSON.parse(chartElement.dataset.backgroundColor);

const ctx = document.getElementById('pegawaiChart').getContext('2d');
const pegawaiChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [''], // keep empty label to avoid grouping
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
                position: 'bottom',
                labels: {
                    generateLabels: function (chart) {
                        const datasets = chart.data.datasets;

                        // Build legend items for each dataset
                        const labels = datasets.map((dataset, i) => ({
                            text: `${dataset.label} (${dataset.data[0]} Orang)`,
                            fillStyle: dataset.backgroundColor,
                            strokeStyle: dataset.borderColor || dataset.backgroundColor,
                            index: i,
                            fontColor: 'rgba(17, 17, 17, 0.8)'
                        }));

                        return labels;
                    }
                }
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
                display: false
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
                position: 'bottom',
                labels: {
                    generateLabels: function (chart) {
                        const data = chart.data;
                        return data.labels.map((label, i) => {
                            const dataset = chart.data.datasets[0];
                            return {
                                text: `${label} (${dataset.data[i]} Orang)`,
                                fillStyle: dataset.backgroundColor[i],
                                strokeStyle: dataset.borderColor ? dataset.borderColor[i] : dataset.backgroundColor[i],
                                index: i,
                                fontColor: 'rgba(17, 17, 17, 0.8)'
                            };
                        });
                    }
                }
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

const chartElement4 = document.getElementById('jenisTenagaKerjaWrapper');
const chartLabels4 = JSON.parse(chartElement4.dataset.labels);
const chartData4 = JSON.parse(chartElement4.dataset.values);
const chartBackgroundColor4 = JSON.parse(chartElement4.dataset.backgroundColor);

const ctx4 = document.getElementById('chartJenisTenagaData').getContext('2d');
const chartJenisTenagaData = new Chart(ctx4, {
    type: 'bar',
    data: {
        labels: [''], // keep empty label to avoid grouping
        datasets: chartLabels4.map((label, index) => ({
            label: label,
            data: [chartData4[index]],
            backgroundColor: chartBackgroundColor4[index],
            borderWidth: 1
        }))
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    generateLabels: function (chart) {
                        const datasets = chart.data.datasets;

                        // Build legend items for each dataset
                        const labels = datasets.map((dataset, i) => ({
                            text: `${dataset.label} (${dataset.data[0]} Orang)`,
                            fillStyle: dataset.backgroundColor,
                            strokeStyle: dataset.borderColor || dataset.backgroundColor,
                            index: i,
                            fontColor: 'rgba(17, 17, 17, 0.8)'
                        }));

                        return labels;
                    }
                }
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
                display: false
            }
        }
    }
});

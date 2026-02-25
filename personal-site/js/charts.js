// Personal Site - Impact Data Visualizations
// Powered by Chart.js

document.addEventListener('DOMContentLoaded', () => {
    // Chart 1: Open Data Adoption Trend
    const trendCtx = document.getElementById('chart-impact-trend');
    if (trendCtx) {
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026'],
                datasets: [{
                    label: 'Cities with Open Data Mandates',
                    data: [2, 3, 5, 8, 12, 18, 24, 32, 42, 58, 78, 95],
                    borderColor: '#E60000',
                    backgroundColor: 'rgba(230, 0, 0, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#E60000',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        backgroundColor: 'rgba(11, 28, 51, 0.9)',
                        titleFont: {
                            family: "'Merriweather', serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' cities';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 11
                            }
                        },
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Chart 2: Expertise Areas Pie Chart
    const expertiseCtx = document.getElementById('chart-expertise');
    if (expertiseCtx) {
        new Chart(expertiseCtx, {
            type: 'doughnut',
            data: {
                labels: ['Open Data', 'Civic Tech', 'Urban Planning', 'Digital Identity', 'Other'],
                datasets: [{
                    data: [35, 28, 18, 12, 7],
                    backgroundColor: [
                        '#E60000',
                        '#0B1C33',
                        '#1a2f4d',
                        '#888',
                        '#ccc'
                    ],
                    borderWidth: 0,
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        labels: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            },
                            padding: 10,
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        return {
                                            text: label + ' (' + value + '%)',
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(11, 28, 51, 0.9)',
                        titleFont: {
                            family: "'Merriweather', serif",
                            size: 14
                        },
                        bodyFont: {
                            family: "'Inter', sans-serif",
                            size: 13
                        },
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '% of projects';
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }
});

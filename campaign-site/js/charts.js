// Campaign Site - Chart Visualizations
// Powered by Chart.js

document.addEventListener('DOMContentLoaded', () => {
    // Chart 1: Issue Priority Trend (Line Chart)
    const trendCtx = document.getElementById('chart-priority-trend');
    if (trendCtx) {
        new Chart(trendCtx, {
            type: 'line',
            data: {
                labels: ['Aug 2025', 'Sep 2025', 'Oct 2025', 'Nov 2025', 'Dec 2025', 'Jan 2026', 'Feb 2026'],
                datasets: [
                    {
                        label: 'Housing',
                        data: [78, 82, 84, 85, 86, 87, 87],
                        borderColor: '#E60000',
                        backgroundColor: 'rgba(230, 0, 0, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Education',
                        data: [68, 70, 72, 74, 75, 76, 76],
                        borderColor: '#0B1C33',
                        backgroundColor: 'rgba(11, 28, 51, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Transit',
                        data: [55, 58, 62, 64, 66, 67, 68],
                        borderColor: '#1a2f4d',
                        backgroundColor: 'rgba(26, 47, 77, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Public Safety',
                        data: [65, 67, 68, 70, 71, 72, 72],
                        borderColor: '#888',
                        backgroundColor: 'rgba(136, 136, 136, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            font: {
                                family: "'Inter', sans-serif",
                                size: 12
                            },
                            padding: 15,
                            usePointStyle: true
                        }
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
                        displayColors: true
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 50,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            },
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
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                }
            }
        });
    }

    // Chart 2: Demographics Pie Chart
    const demoCtx = document.getElementById('chart-demographics');
    if (demoCtx) {
        new Chart(demoCtx, {
            type: 'doughnut',
            data: {
                labels: ['18-29', '30-44', '45-64', '65+'],
                datasets: [{
                    data: [18, 32, 35, 15],
                    backgroundColor: [
                        '#E60000',
                        '#0B1C33',
                        '#1a2f4d',
                        '#888'
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
                                size: 13
                            },
                            padding: 12,
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
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }
});

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="{{url('css/wykresy.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-inner">
                <div class="card-title">
                    <h2>Weather Statistics</h2>
                </div>
                <div class="chart-container">
                    <canvas id="salesStatistics"></canvas>
                </div>
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .container -->
  
    <script>
        var temperatures = {{ json_encode($temperatures) }};
        var pressures  = {{ json_encode($pressures) }};
        var humidities = {{ json_encode($humidities) }};
        var timestamps = {!! json_encode($timestamps) !!};

        var salesData = {
            labels: timestamps,
            datasets: [{
                label: 'Temperature',
                data: temperatures,
                borderColor: '#0fac81',
                borderWidth: 2,
                fill: false
            }, {
                label: 'Pressure',
                data: pressures,
                borderColor: '#eb6459',
                borderWidth: 2,
                fill: false
            }, {
                label: 'Humidity',
                data: humidities,
                borderColor: '#254d99',
                borderWidth: 2,
                fill: false
            }]
        };

        var ctx = document.getElementById('salesStatistics').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: salesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 10
                        },
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        },
                        gridLines: {
                            color: '#ccc',
                            lineWidth: 1
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontSize: 14,
                        boxWidth: 20,
                        padding: 20
                    }
                }
            }
        });
    </script>
</body>
</html>

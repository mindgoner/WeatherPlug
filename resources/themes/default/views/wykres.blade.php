<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Statistics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xxl-6">
                <div class="card card-full">
                    <div class="nk-ecwg nk-ecwg8 h-100">
                        <div class="card-inner">
                            <div class="card-title-group mb-3">
                                <div class="card-title">
                                    <h6 class="title">Statystyki pogodowe</h6>
                                </div>
                            </div>
                            <div class="chart-container">
                                <canvas class="ecommerce-line-chart-s4" id="salesStatistics"></canvas>
                            </div>
                        </div><!-- .card-inner -->
                    </div><!-- .nk-ecwg -->
                </div><!-- .card -->
            </div><!-- .col -->
        </div><!-- .row -->
    </div><!-- .container -->

    <script>
        var temperatures = <?php echo json_encode($temperatures); ?>;
        var pressures  = <?php echo json_encode($pressures); ?>;
        var humidities = <?php echo json_encode($humidities); ?>;
        var timestamps = <?php echo json_encode($timestamps); ?>;
        // Sample data (replace with your own)
        var salesData = {
            labels: timestamps,
            datasets: [{
                label: 'Temperatura',
                data: temperatures,
                borderColor: '#0fac81',
                borderWidth: 1
            }, {
                label: 'Ciśnienie',
                data:pressures ,
                borderColor: '#eb6459',
                borderWidth: 1
            }, {
                label: 'Wilgotność',
                data:humidities ,
                borderColor: '#254d99',
                borderWidth: 1

            }]
        };

        // Create chart
        var ctx = document.getElementById('salesStatistics').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'line',
            data: salesData,
            options: {
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 10
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</body>
</html>

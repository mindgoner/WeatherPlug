<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Visualization</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #averageSensorChart{
            width: 100%;
            max-width: 1600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h1>Sensor Data Visualization</h1>
    </div>
    <canvas id="averageSensorChart" width="400" height="200" style="margin-top: 20px;"></canvas>

    <script>
        $(document).ready(function () {
            // Initialize chart for averaged data
            const avgCtx = document.getElementById('averageSensorChart').getContext('2d');
            const averageSensorChart = new Chart(avgCtx, {
                type: 'line',
                data: {
                    labels: [], // Period labels
                    datasets: [
                        {
                            label: 'Average Temperature (°C)',
                            data: [],
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            borderWidth: 1
                        },
                        {
                            label: 'Average Humidity (%)',
                            data: [],
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Period'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        }
                    }
                }
            });

            // Function to fetch average sensor data
            function fetchAverageSensorData() {
                console.log('{{ $mode }}');
                $.ajax({
                    url: '{{ route("api.sensor.avg-raw-readings", ["sensorId" => $sensorId]) }}',
                    data: {
                        mode: '{{ $mode }}',
                        limit: '{{ $limit }}',
                        sensorId: '{{ $sensorId }}'
                    },
                    method: 'GET',
                    success: function (response) {
                        if (response.success) {
                            const data = response.data;
                            data.sort((a, b) => new Date(`${a.period}`) - new Date(`${b.period}`));
                            const labels = data.map(reading => reading.period);
                            const avgTemperatures = data.map(reading => reading.avgTemperature);
                            const avgHumidities = data.map(reading => reading.avgHumidity);


                            // Update average chart data
                            averageSensorChart.data.labels = labels;
                            averageSensorChart.data.datasets[0].data = avgTemperatures;
                            averageSensorChart.data.datasets[1].data = avgHumidities;

                            // Refresh average chart
                            averageSensorChart.update();
                        } else {
                            console.error('Failed to retrieve average sensor data:', response);
                        }
                    },
                    error: function (error) {
                        console.error('AJAX error:', error);
                    }
                });
            }

            // Fetch data every second
            setInterval(fetchAverageSensorData, 5000);

            fetchAverageSensorData();
        });
    </script>
</body>
</html>

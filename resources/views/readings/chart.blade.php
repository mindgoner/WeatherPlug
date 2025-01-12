<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sensor Data Visualization</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #sensorChart{
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
    <canvas id="sensorChart" width="400" height="200"></canvas>

    <script>
        $(document).ready(function () {
            // Initialize chart
            const ctx = document.getElementById('sensorChart').getContext('2d');
            const sensorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [], // Time labels
                    datasets: [
                        {
                            label: 'Temperature (°C)',
                            data: [],
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderWidth: 1
                        },
                        {
                            label: 'Humidity (%)',
                            data: [],
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
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
                                text: 'Time'
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

            // Function to fetch data and update chart
            function fetchSensorData() {
                $.ajax({
                    url: '{{ route("api.sensor.raw-readings", ["limit" => $limit, "sensorId" => $sensorId]) }}',
                    method: 'GET',
                    success: function (response) {
                        if (response.success) {
                            let data = response.data;

                            // Sort data by time in ascending order
                            data.sort((a, b) => new Date(`${a.readingDate}T${a.readingTime}`) - new Date(`${b.readingDate}T${b.readingTime}`));

                            const labels = data.map(reading => reading.readingTime);
                            const temperatures = data.map(reading => reading.readingTemperature);
                            const humidities = data.map(reading => reading.readingHumidity);

                            // Update chart data
                            sensorChart.data.labels = labels;
                            sensorChart.data.datasets[0].data = temperatures;
                            sensorChart.data.datasets[1].data = humidities;

                            // Refresh chart
                            sensorChart.update();
                        } else {
                            console.error('Failed to retrieve sensor data:', response);
                        }
                    },
                    error: function (error) {
                        console.error('AJAX error:', error);
                    }
                });
            }

            // Fetch data every second
            setInterval(fetchSensorData, 1000);

            // Initial fetch
            fetchSensorData();
        });
    </script>
</body>
</html>

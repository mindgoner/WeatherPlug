# WeatherPlug

WeatherPlug is a companion application compatible with WeatherPlug Server, but built on Arduino for ESP8266 microcontroller boards. It serves to gather weather data from various sensors and transmit it to WeatherPlug Server for further processing and analysis.

## Features

- Collecting weather data from sensors connected to ESP8266 microcontroller boards.
- Transmitting collected data to WeatherPlug Server for storage and analysis.

## Requirements

- Arduino IDE or any compatible IDE for ESP8266 development
- ESP8266 microcontroller board
- Sensors for measuring weather parameters (e.g., temperature, humidity, pressure)

## Installation

1. Clone the WeatherPlug repository: `git clone https://github.com/mindgoner/WeatherPlug.git`
2. Open the project in Arduino IDE or your preferred IDE for ESP8266 development.
3. Configure the necessary settings such as Wi-Fi credentials and WeatherPlug Server API endpoint in the source code.
4. Connect the ESP8266 microcontroller board to your computer via USB.
5. Compile and upload the sketch to the microcontroller board.
6. Once uploaded, the WeatherPlug device will start collecting weather data and transmitting it to WeatherPlug Server.

## Integration with WeatherPlug Server

To integrate WeatherPlug with WeatherPlug Server:
1. Ensure that WeatherPlug Server is installed and running as per its installation instructions.
2. Configure WeatherPlug to transmit data to the appropriate endpoint in WeatherPlug Server (usually via HTTP(s) POST request).
3. Test the integration by observing data reception in WeatherPlug Server.

## Notes

- Make sure to configure appropriate sensor connections and calibration in the WeatherPlug source code according to your sensor setup.

## License

WeatherPlug follows the same license as WeatherPlug Server, which is the MIT License. For more information, see the LICENSE file in the WeatherPlug Server repository.

#include "WeatherPlug.h"

const char* ssid = "SSID";
const char* password = "PASSWORD";
const char* apiKey = "ABCabc123DEFdef456";
const char* domain = "weatherplug.com";

WeatherPlug WeatherPlug(ssid, password, apiKey, domain);

void setup() {
  Serial.begin(115200);
  WeatherPlug.testWiFiConnection();
}

void loop() {
  WeatherPlug.readSimulatedSensors();
  WeatherPlug.exchangeData();
}

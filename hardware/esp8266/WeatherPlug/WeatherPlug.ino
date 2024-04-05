#include "WeatherPlug.h"

const char* ssid = "WIFI_SSID";
const char* password = "WIFI_PASSWORD";
const char* apiKey = "ABCabc123DEFdef456";
const char* serverUrl = "https://weatherplug.com/collector";

WeatherPlug WeatherPlug(ssid, password, apiKey, serverUrl);

void setup() {
  Serial.begin(9600);
  WeatherPlug.connectWiFi();
}

void loop() {
  WeatherPlug.readSensors();
  WeatherPlug.sendData(5);
}

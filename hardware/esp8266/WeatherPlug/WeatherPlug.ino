#include "WeatherPlug.h"

const char* ssid = "ABBA";
const char* password = "BABA";
const char* apiKey = "ABCabc123DEFdef456";
const char* serverUrl = "weatherplug.com";
const char* serverPort = "443";

WeatherPlug WeatherPlug(ssid, password, apiKey, serverUrl, serverPort);

void setup() {
  Serial.begin(9600);
  WeatherPlug.connectWiFi();
}

void loop() {
  WeatherPlug.readSensors();
  WeatherPlug.exchangeData(5);
}

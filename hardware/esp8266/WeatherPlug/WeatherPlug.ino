#include "WeatherPlug.h"

const char* ssid = "WIFI";
const char* password = "PASSWORD";
const char* apiKey = "ABCabc123DEFdef456";
const char* serverUrl = "weatherplug.com";
const char* serverPort = "80";

WeatherPlug WeatherPlug(ssid, password, apiKey, serverUrl, serverPort);

void setup() {
  Serial.begin(9600);
  WeatherPlug.connectWiFi();
}

void loop() {
  WeatherPlug.readSensors();
  WeatherPlug.sendData(5);
}

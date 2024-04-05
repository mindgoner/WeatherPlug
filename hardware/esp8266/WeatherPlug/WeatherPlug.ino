#include "WeatherPlug.h"

const char* ssid = "Minerva";
const char* password = "La'R0s3s";
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
  WeatherPlug.sendData(5);
}

#include "WeatherPlug.h"
#include <WiFiClientSecure.h>

// Inicjalizacja obiektu klienta
WiFiClientSecure client;

WeatherPlug::WeatherPlug(const char* ssid, const char* password, const char* apiKey, const char* serverUrl, const char* serverPort) {
  this->ssid = ssid;
  this->password = password;
  this->apiKey = apiKey;
  this->serverUrl = serverUrl;
  this->serverPort = serverPort;

  // Default values:
  this->environmentTemperature = 24;
  this->environmentHumidity = 40.0;
  this->atmosphericPressure = 1013.25;
}

void WeatherPlug::connectWiFi() {
  // Połączenie z siecią WiFi
  WiFi.begin(this->ssid, this->password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("Connected to WiFi");

  // Połączenie z serwerem za pomocą zabezpieczonego klienta
  if (!client.connect(this->serverUrl, atoi(this->serverPort))) {
    Serial.println("Connection failed");
    return;
  }
}

void WeatherPlug::readSensors() {
  // Replace with real readings
  this->environmentTemperature = 25.5;
  this->environmentHumidity = 60.0;
  this->atmosphericPressure = 1013.25;
}

void WeatherPlug::readSimulatedSensors() {
  float temperatureChange = random(0, 3); 
  if (random(0, 2) == 0) {
    this->environmentTemperature += temperatureChange;
  } else {
    this->environmentTemperature -= temperatureChange;
  }

  if (this->environmentTemperature > 80) {
    this->environmentTemperature = 80;
  } else if (this->environmentTemperature < -12) {
    this->environmentTemperature = -12;
  }

  float humidityChange = random(-3, 4); // losowa wartość z zakresu -2% do 3%
  this->environmentHumidity += humidityChange;
  if (this->environmentHumidity > 90) {
    this->environmentHumidity = 90;
  } else if (this->environmentHumidity < 20) {
    this->environmentHumidity = 20;
  }

  float pressureChange = random(-2, 3); 
  this->atmosphericPressure += pressureChange;
  if (this->atmosphericPressure > 1020) {
    this->atmosphericPressure = 1020;
  } else if (this->atmosphericPressure < 1000) {
    this->atmosphericPressure = 1000;
  }
}


String WeatherPlug::getMACAddress() {
  // Pobranie adresu MAC urządzenia
  byte mac[6];
  WiFi.macAddress(mac);
  char macStr[18] = {0};
  snprintf(macStr, sizeof(macStr), "%02x%02x%02x%02x%02x%02x", mac[0], mac[1], mac[2], mac[3], mac[4], mac[5]);
  return String(macStr);
}

void WeatherPlug::exchangeData(int postSendDelay) {
  String url = "/api/data?deviceMac=" + this->getMACAddress() + "&temperature=" + String(this->environmentTemperature) + "&humidity=" + String(this->environmentHumidity) + "&pressure=" + String(this->atmosphericPressure);
  Serial.print("Requesting URL: ");
  Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + this->serverUrl + "\r\n" +
               "Connection: close\r\n\r\n");
  String response = "";
  while (client.connected()) {
  Serial.println("Client connected");
    if (client.available()) {
  Serial.println("Client available");
      response += client.readStringUntil('\r');
    }
  }
  Serial.println(response);
  Serial.println("Request complete");
  delay(postSendDelay * 1000);
}


void WeatherPlug::setTemperature(float temperature) {
  this->environmentTemperature = temperature;
}

void WeatherPlug::setHumidity(float humidity) {
  this->environmentHumidity = humidity;
}

void WeatherPlug::setPressure(float pressure) {
  this->atmosphericPressure = pressure;
}

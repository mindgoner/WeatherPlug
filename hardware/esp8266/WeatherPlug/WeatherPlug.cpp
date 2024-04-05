#include "WeatherPlug.h"

WeatherPlug::WeatherPlug(const char* ssid, const char* password, const char* apiKey, const char* serverUrl, const char* serverPort) {
  this->ssid = ssid;
  this->password = password;
  this->apiKey = apiKey;
  this->serverUrl = serverUrl;
  this->serverPort = serverPort;
}

void WeatherPlug::connectWiFi() {
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

void WeatherPlug::readSensors() {
  // TODO: Replace these with actual sensor readings
  this->environmentTemperature = 25.5;
  this->environmentHumidity = 60.0;
  this->atmosphericPressure = 1013.25;
}

String WeatherPlug::getMACAddress() {
  byte mac[6];
  WiFi.macAddress(mac);
  char macStr[18] = {0};
  snprintf(macStr, sizeof(macStr), "%02x:%02x:%02x:%02x:%02x:%02x", mac[0], mac[1], mac[2], mac[3], mac[4], mac[5]);
  return String(macStr);
}

void WeatherPlug::sendData(int postSendDelay = 1) {
  if (WiFi.status() == WL_CONNECTED) {
    uint16_t port = atoi(serverPort);
      // Łączenie z serwerem
      if (!client.connect(String(serverUrl), port)) {
        Serial.println("Connection failed");
        return;
      }
    
      // Wysłanie żądania GET do serwera
      client.print("GET /collect HTTP/1.1\r\n");
      client.print("Host: "+String(serverUrl)+"\r\n");
      client.print("Connection: close\r\n\r\n");
    
      Serial.println("Request sent");
    
      // Oczekiwanie na odpowiedź
      while (client.connected()) {
        if (client.available()) {
          // Wypisanie odpowiedzi serwera na Serial Monitor
          Serial.write(client.read());
        }
      }
  } else {
    Serial.println("Not connected to WiFi");
  }

  // Read response from server
  while (client.available()) {
    String line = client.readStringUntil('\r');
    if (line.indexOf("failed") != -1) {
      String failMessage = line.substring(line.indexOf(":") + 1);
      Serial.println("Server response: " + failMessage);
    }
  }

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

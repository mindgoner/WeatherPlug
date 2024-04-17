#include "WeatherPlug.h"
#include <Arduino.h>
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>

// Inicjalizacja obiektu klienta
ESP8266WiFiMulti WiFiMulti;

WeatherPlug::WeatherPlug(const char* ssid, const char* password, const char* apiKey, const char* domain) {

  // Debug types:
  this->debug = "all"; // Allowed: connection, readings, all
  
  // Default values:
  this->environmentTemperature = 24;
  this->environmentHumidity = 40.0;
  this->atmosphericPressure = 1013.25;

  // Configure
  this->ssid = ssid;
  this->password = password;
  this->apiKey = apiKey;
  this->domain = domain;
  this->exchangeDelay = 5000;
  this->endpointPath = "/api/data";
  this->updateExchangeUrl();
  WiFiMulti.addAP(this->ssid, this->password);

}
void WeatherPlug::updateExchangeUrl(){
  this->exchangeUrl = "http://"+String(domain)+String(this->endpointPath)+"?deviceMac="+String(this->getMACAddress())+"&Temperatura="+String(this->environmentTemperature)+"&Wilgotnosc="+String(this->environmentHumidity)+"&Cisnienie="+String(this->atmosphericPressure);  
}
void WeatherPlug::changeEndpointPath(String endpointPath) {
  this->endpointPath = endpointPath;
  this->updateExchangeUrl();
}
void WeatherPlug::testWiFiConnection() {
  // Connectiong to WiFi
  
  if(this->debug == "connection" || this->debug == "all") Serial.print("Connecting to WiFi (waiting for status 3): ");
  WiFi.begin(this->ssid, this->password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    if(this->debug == "connection" || this->debug == "all") Serial.print(WiFi.status());
  }
  if(this->debug == "connection" || this->debug == "all") Serial.println(" Connected!");
}

void WeatherPlug::readSensors() {
  // Replace with real readings
  this->environmentTemperature = 25.5;
  this->environmentHumidity = 60.0;
  this->atmosphericPressure = 1013.25;
  this->updateExchangeUrl();
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
  this->updateExchangeUrl();
  if(this->debug == "readings" || this->debug == "all") Serial.println("New readings! Temperature: "+String(environmentTemperature)+"°C Humidity: "+String(environmentHumidity)+"% AtmosphericPressure: "+String(atmosphericPressure)+"hPa.");
}


String WeatherPlug::getMACAddress() {
  // Pobranie adresu MAC urządzenia
  byte mac[6];
  WiFi.macAddress(mac);
  char macStr[18] = {0};
  snprintf(macStr, sizeof(macStr), "%02x%02x%02x%02x%02x%02x", mac[0], mac[1], mac[2], mac[3], mac[4], mac[5]);
  return String(macStr);
}

void WeatherPlug::exchangeData() {
  if(this->debug == "connection" || this->debug == "all") Serial.println("Exchanging data: ");
  if ((WiFiMulti.run() == WL_CONNECTED)) {  
    if(this->debug == "connection" || this->debug == "all") Serial.println("[WIFI] Connected to WiFi: OK!");

    // Make clients:
    WiFiClient client;
    HTTPClient http;
    if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Beginning transmission. Transmitting to endpoint:");
    if(this->debug == "connection" || this->debug == "all") Serial.println(this->exchangeUrl);
    if (http.begin(client, this->exchangeUrl)) {
      if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Succesfully connected to server via HTTP Protocol. Downloading data...");

      // Downloading data:
      int httpCode = http.GET();
      if (httpCode > 0) {
        if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Succesfully downloaded data!");
        
        if(httpCode == HTTP_CODE_OK){
          if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Server responded with success. Data from sensor has been stored in database!");
          
        }else{
          if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] HTTP Code is different than 200 (is equal "+String(httpCode)+"). Transmission FAILED! Check server settings");
        }
        
      }else{
        if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Data downloading FAILED! HTTPCode: "+String(httpCode));
      }

      
    }else{
      if(this->debug == "connection" || this->debug == "all") Serial.println("[HTTP] Connecting to server via HTTP Protocol FAILED! ErrorCode: "+String(http.begin(client, this->exchangeUrl)));
    }
  }else{
    if(this->debug == "connection" || this->debug == "all") Serial.println("[WIFI] Connected to WiFi: FAILURE! ErrorCode: "+String(WiFiMulti.run()));
  }
  
  delay(this->exchangeDelay);
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

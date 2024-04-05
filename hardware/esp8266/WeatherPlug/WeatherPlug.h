#ifndef WeatherPlug_ESP8266_H
#define WeatherPlug_ESP8266_H

#include <ESP8266WiFi.h>
#include <ArduinoJson.h>

class WeatherPlug {
  private:
    const char* ssid;
    const char* password;
    const char* apiKey;
    const char* serverUrl;
    const char* serverPort;

    float environmentTemperature;
    float environmentHumidity;
    float atmosphericPressure;

    WiFiClient client;

  public:
    WeatherPlug(const char* ssid, const char* password, const char* apiKey, const char* serverUrl, const char* serverPort);
    void connectWiFi();
    void readSensors();
    void sendData(int postSendDelay);
    String getMACAddress();

    void setTemperature(float temperature);
    void setHumidity(float humidity);
    void setPressure(float pressure);
};

#endif

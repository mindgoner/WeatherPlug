#include "WeatherPlug.h"
#include <DHT.h>

// Uncomment for DHT11 sensor example

//#define DHTPIN 2      // Pin D4 (GPIO2) at ESP8266
//#define DHTTYPE DHT11 // Sensor type: DHT11 (example)

const char* ssid = "WeatherPlug";
const char* password = "12345678";
const char* apiKey = "ABCabc123DEFdef456"; // ToDo: add apikey whitelist
const char* domain = "weatherplug.com";

WeatherPlug WeatherPlug(ssid, password, apiKey, domain);
//DHT dht(DHTPIN, DHTTYPE);

void setup() {
  Serial.begin(115200);
  WeatherPlug.testWiFiConnection();
  //dht.begin();
}

void loop() {

  //float temp = dht.readTemperature();
  //float hum = dht.readHumidity();

  // Sprawdzenie, czy odczyt się powiódł
  //if (isnan(temp) || isnan(hum)) {
    //Serial.println("Błąd odczytu z sensora DHT11");
    //return;
  //}

  WeatherPlug.setTemperature(21); // Or use variable temp
  WeatherPlug.setHumidity(65); // Or use variable hum
  WeatherPlug.exchangeData();
}

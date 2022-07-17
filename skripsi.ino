#include <LiquidCrystal_I2C.h>
#include <ArduinoJson.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>
#include <Adafruit_MLX90614.h>
#include <Wire.h>

LiquidCrystal_I2C lcd(0x27, 16, 2);
Adafruit_MLX90614 mlx = Adafruit_MLX90614();

//setting wifi
const char* ssid = "realme 5";
const char* password = "12345678";
//setting kode alat
String kode_valid = "abcd";
//variabel untuk sensor suhu
float bodytemp, Y, Z;
//variabel host wifi
String host = "absensi12345678.000webhostapp.com";

String ket;



// deklarasi pin
#define SDA D2
#define SCL D1
WiFiClient wificlient;

void setup () {
  mlx.begin();
  lcd.begin();
  lcd.setCursor(0, 0);
  lcd.print("CONTACTLESS TEMP");
  Serial.begin(115200);
  WiFi.begin(ssid, password);
  Serial.println("==================================================");
//  Serial.println("Hello World!");
//  Serial.println("IoT Project - Laurensius Dede Suhardiman!");
//  Serial.println("http://laurensius-dede-suhardiman.com/");
//  Serial.println("==================================================");
  Serial.println("Setting NodeMCU");

  delay(1000);
  wifiConnecting();
}

void loop() {
  //panggil file backphp
  String url = "http://absensi12345678.000webhostapp.com/back.php";
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(wificlient, url);
    int httpCode = http.GET();
    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println("HTTP Response Code : ");
      Serial.println(httpCode);
      Serial.println("HTTP Response Payload : ");
      //Serial.println(payload);
      //Parsing data user
      const size_t bufferSize1 = JSON_OBJECT_SIZE(6);
      DynamicJsonBuffer jsonBuffer1(bufferSize1);
      JsonObject& root1 = jsonBuffer1.parseObject(http.getString());
      // Parameters
      const char* kode = root1["kode"]; // "kode valid"
      const char* username = root1["username"]; // "kode valid"
      const char* nama = root1["nama"]; // "kode valid"
      const char* tanggal = root1["tanggal"]; // "kode valid"
      const char* masuk = root1["masuk"]; // "kode valid"
      const char* keluar = root1["keluar"]; // "kode valid"
      const char* randoms = root1["random"]; // "kode valid"
      const char* valid = root1["valid"]; // "kode valid"
      // Output to serial monitor
      Serial.print("kode :");
      Serial.println(kode);
      Serial.print("username :");
      Serial.println(username);
      Serial.print("nama :");
      Serial.println(nama);
      Serial.print("tanggal :");
      Serial.println(tanggal);
      Serial.print("masuk :");
      Serial.println(masuk);
      Serial.print("keluar :");
      Serial.println(keluar);
      Serial.print("random :");
      Serial.println(randoms);
      Serial.print("valid :");
      Serial.println(valid);
      String kode_string = String(kode);
      String valid_int = String(valid);

      
      //triger

      if (kode_string == kode_valid && valid_int == "FALSE") {
        //ukur suhu
        for ( uint32_t tStart = millis();  (millis() - tStart) < 15000;) {
          bodytemp = mlx.readObjectTempC();
          Y = (0.3734 * bodytemp) + 23.317;
          //Z = round(Y);
          lcd.setCursor(0, 1);
          lcd.print("BodyTemp");
          lcd.print(Y,1);
          lcd.print(char(233));
          lcd.print("C");
          Serial.print("Suhu :");
          Serial.println(Y,1);
          if (Y > 37.5 || Y< 35.0) {
            ket = "sakit";
          }
          else {
            ket = "masuk";
          }
        }
        //kirim data
        Serial.println("Mengirim data...");
        WiFiClient client;
        const int httpPort = 80;
        if (!client.connect(host, httpPort)) {
          Serial.println("connection failed");
          return;
        }

        // We now create a URI for the request
        String url = "/add.php?";
        url += "kode=";
        url += kode;
        url += "&";
        //  url += "username=";
        //  url += username;
        //  url += "&";
        //  url += "nama=";
        //  url += nama;
        //  url += "&";
        //  url += "tanggal=";
        //  url += tanggal;
        //  url += "&";
        //  url += "masuk=";
        //  url += masuk;
        //  url += "&";
        //  url += "keluar=";
        //  url += keluar;
        //  url += "&";
        url += "randoms=";
        url += randoms;
        url += "&";
        url += "suhu=";
        url += Y;
        url += "&";
        url += "valid=";
        url += valid;
        url += "&";
        url += "ket=";
        url += ket;


        Serial.print("Requesting URL: ");
        Serial.println(url);

        // Mengirimkan Request ke Server -----------------------------------------------
        client.print(String("GET ") + url + " HTTP/1.1\r\n" +
                     "Host: " + host + "\r\n" +
                     "Connection: close\r\n\r\n");
        unsigned long timeout = millis();
        while (client.available() == 0) {
          if (millis() - timeout > 1000) {
            Serial.println(">>> Client Timeout !");
            client.stop();
            return;
          }
        }
        // akhir mengirimkan..



      }

    }
    http.end();
  } else if (WiFi.status() != WL_CONNECTED) {
    Serial.println("NodeMCU tidak terhubung ke Access Point");
    wifiConnecting();
  }
  delay(5000);
}

void wifiConnecting() {
  while (WiFi.status() != WL_CONNECTED) {
    Serial.println("Menghubungkan ke Access Point");
    for (int c = 0; c < 3; c++) {
      Serial.print(" .");
      delay(1000);
    }
    Serial.println();
  }
}

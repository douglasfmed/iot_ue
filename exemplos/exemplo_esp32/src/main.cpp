#include <WiFi.h>
#include <HTTPClient.h>

#include <NTPClient.h> // Esta biblioteca esta na pasta "lib" do projeto
#include <WiFiUdp.h>

// Configuracoes da rede Wi-Fi
const char* ssid = "NET 204 1";
const char* password =  "joaopessoa1@";

// Define NTP Client to get time
WiFiUDP ntpUDP;
NTPClient timeClient(ntpUDP);

// Variables to save date and time
String infoTime;
String dia;
String mes;
String ano;
String hora;
String minuto;
String segundo;

int comuta = 0;

void setup() {
    Serial.begin(115200);

    Serial.print("Conectando em ");
    Serial.println(ssid);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
      delay(500);
      Serial.print(".");
    }
    // Print local IP address and start web server
    Serial.println("");
    Serial.println("WiFi conectado!");

    // Initialize a NTPClient to get time
    timeClient.begin();
    // Ajuste de fuso horario
    // GMT -3 = -3*3600 = -10800
    timeClient.setTimeOffset(-10800);
}

void loop() {

  if ((WiFi.status() == WL_CONNECTED)) {

    while(!timeClient.update()) {
      timeClient.forceUpdate();
    }

    // The formattedDate comes with the following format:
    // 2018-05-28T16:00:13Z
    infoTime = timeClient.getFormattedDate();
    //Serial.println(infoTime);

    // Separando as variaveis de data e hora
    ano = infoTime.substring(0,4);
    mes = infoTime.substring(5,7);
    dia = infoTime.substring(8,10);
    hora = infoTime.substring(11,13);
    minuto = infoTime.substring(14,16);
    segundo = infoTime.substring(17,19);

    HTTPClient http;

        //http.begin("http://sanusb.org/ftpmonitor/getESP_condut.php?action=send1&condut=50&date="+ano+"-"+mes+"-"+dia+"-"+hora+":"+minuto+":"+segundo);

        if(comuta == 0){
          http.begin("http://microengenharia.sytes.net:4000/iot_ue/dados/enviar.php?id_planta=6&data="+ano+"-"+mes+"-"+dia+"&hora="+hora+":"+minuto+":"+segundo+"&teste=10");
          comuta = 1;
        } else{
          http.begin("http://microengenharia.sytes.net:4000/iot_ue/dados/enviar.php?id_planta=6&data="+ano+"-"+mes+"-"+dia+"&hora="+hora+":"+minuto+":"+segundo+"&teste=50");
          comuta = 0;
        }

        int httpCode = http.GET();

        if (httpCode > 0) { // Check for the returning code

        String payload = http.getString();
          Serial.println(httpCode);
          Serial.println(payload);
        } else {
          //Serial.println(httpCode);
          Serial.println("Erro na requisição HTTP GET!");
        }

        http.end();

        delay(60000*5);

  } else{
    Serial.println("Problemas com a conexao WIFI");
  }

}

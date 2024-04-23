#include <WiFi.h>

const char* ssid = "caio";
const char* pass = "12345678";

IPAddress server(192,168,0,114);

WiFiClient client;

float litroMinuto;

void setup() {
    WiFi.begin(ssid, pass);

    while (WiFi.status() != WL_CONNECTED) {
    Serial.println(".");
    delay(500);
    }
}

void loop(){
    litroMinuto = 10;

    if(isnan(litroMinuto)) {
        error();
    }else{
    String response = "";

    if(client.connect(server, 80)) {
        Serial.println("Conexão com o servidor");
        client.printf("GET /sistema-swc/lib/config.php?litroMinuto=%f2.2HTTP/1.1\r\n", litroMinuto);
        client.println("Host: 192.168.0.114:80");
        client.println("Conexao fechada");
        client.println();
    }
    delay(1000);

    while(!client.connected()) {
        Serial.println("Fim de conexao");
        if(response.indexOf("sucesso") >= 0) 
        sucess();
        else 
        error();
        client.stop(); 
    }
    delay(60000);
    }
}

void sucess(){
    Serial.println("sucesso");
}
void error(){
    Serial.println("erro");
}
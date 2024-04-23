#include <WiFi.h>

const char* ssid = "caio";
const char* pwd = "12345678";

IPAddress server(192, 168, 107, 1);

WiFiClient client;

void setup() {
    Serial.begin(9600);
    Serial.print("Conectando a: ");
    Serial.println(ssid);

    WiFi.begin(ssid, pwd);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("Iniciando conexao com o server");

    if (client.connect(server, 80)) {
        Serial.println("Conectando ao server");
        client.println("GET /esptest/index.php HTTP/1.1");
        client.println("Host: 192.168.107.1:80");
        client.println("Connection: close");
        client.println();
    }
}

void loop() {
    while (client.available()) {
        char c = client.read();
        Serial.write(c);
    }

    if (!client.connected()) {
        Serial.println();
        Serial.println("Desconectado do server");
        client.stop();

        while (true);
    }
}
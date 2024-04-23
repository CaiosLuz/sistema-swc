#include <WiFi.h>

const int sensorPin = 23; // Pino do sensor
volatile int pulseCount; // Variável volátil para contar os pulsos
unsigned long lastMillis;
const float pulsesPerLiter = 450.0; // Número de pulsos por litro
const int measurementInterval = 60000; // Intervalo de medição em milissegundos (60 segundos)

void IRAM_ATTR pulseCounter() {
    pulseCount++;
}

const char* ssid = "caio";
const char* pwd = "12345678";

IPAddress server(192, 168, 0, 114);

WiFiClient client;

float litroMinuto = 0;

void setup() {

    Serial.begin(9600);
    Serial.print("Conectando a: ");
    Serial.println(ssid);

    WiFi.begin(ssid, pwd);

    pinMode(sensorPin, INPUT_PULLUP); // Configura o pino do sensor como entrada com pull-up interno
    attachInterrupt(digitalPinToInterrupt(sensorPin), pulseCounter, RISING); // Configura a interrupção para contar os pulsos
    pulseCount = 0; // Inicializa o contador de pulsos
    lastMillis = millis(); // Inicializa o tempo da última leitura

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("Iniciando conexao com o server");

    if (client.connect(server, 80)) {
        Serial.println("Conectando ao server");
        char litroMinutoStr[10];
        dtostrf(litroMinuto, 4, 2, litroMinutoStr);
        client.print("GET /sistema-swc/lib/condig.php?litroMinuto=");
        client.print(litroMinutoStr);
        client.println("&key=testeswc HTTP/1.1\r\n");
        client.println("Host: 192.168.0.114:80");
        client.println("Connection: close");
        client.println();
    }
}

void loop() {

    unsigned long currentMillis = millis();
    unsigned long elapsedTime = currentMillis - lastMillis;

    if (elapsedTime >= measurementInterval) { // Calcula a taxa de fluxo a cada minuto
        detachInterrupt(sensorPin); // Desativa a interrupção para evitar condições de corrida
        float flowRate = (pulseCount / pulsesPerLiter) / (measurementInterval / 60000.0); // Calcula a taxa de fluxo em litros por minuto
        Serial.print("Fluxo de água por minuto: ");
        Serial.print(flowRate);
        litroMinuto = flowRate;
        Serial.println(" L/min");
        pulseCount = 0; // Reinicia o contador de pulsos
        lastMillis = currentMillis; // Atualiza o tempo da última leitura
        attachInterrupt(digitalPinToInterrupt(sensorPin), pulseCounter, RISING); // Reativa a interrupção
    }

    String response = ""; // Declaração da variável response

    while (client.available()) {
        char c = client.read();
        response += c; // Correção do erro de digitação
    }

    if (!client.connected()) {
        if (response.indexOf("sucesso") >= 0) {
            sucess();
        } else {
            error();
            client.stop();
            Serial.println("Desconectado do server");
        }
        delay(1800000);
    }
}

void sucess() {
    Serial.println("sucesso"); // Correção do erro de sintaxe
}

void error() {
    Serial.println("erro"); // Correção do erro de sintaxe
}

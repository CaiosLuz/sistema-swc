#include <WiFi.h>

const char* ssid = "caio";
const char* pass = "12345678";

const int sensorPin = 23; // Pino do sensor
volatile int pulseCount; // Variável volátil para contar os pulsos
unsigned long lastMillis;
const float pulsesPerLiter = 450.0; // Número de pulsos por litro
const int measurementInterval = 60000; // Intervalo de medição em milissegundos (60 segundos)

void IRAM_ATTR pulseCounter() {
    pulseCount++;
}

IPAddress server(172,17,97,203);

WiFiClient client;

float litroMinuto;

void setup() {
  WiFi.begin(ssid, pass);

  Serial.begin(9600); // Inicializa a comunicação serial
  pinMode(sensorPin, INPUT_PULLUP); // Configura o pino do sensor como entrada com pull-up interno
  attachInterrupt(digitalPinToInterrupt(sensorPin), pulseCounter, RISING); // Configura a interrupção para contar os pulsos
  pulseCount = 0; // Inicializa o contador de pulsos
  lastMillis = millis(); // Inicializa o tempo da última leitura

  while (WiFi.status() != WL_CONNECTED) {
    Serial.println(".");
    delay(500);
  }
}

void loop(){
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

  if(isnan(litroMinuto)) {
    error();
  }else{
    String response = "";

    if(client.connect(server, 80)) {
      Serial.println("Conexão com o servidor");
      client.printf("GET /sistema-swc/lib/config.php?litroMinuto=%f2.2HTTP/1.1\r\n", litroMinuto);
      client.println("Host: 172.17.97.203:80");
      client.println("Conexao fechada");
      client.println();
    }
    delay(60000);

    while(!client.connected()) {
      Serial.println("Fim de conexao");
      if(response.indexOf("sucesso") >= 0) {
        sucess();
      }else {
        error();
        client.stop(); 
      }
    delay(60000);
    }
  }
}

void sucess(){
  Serial.println("sucesso");
}
void error(){
  Serial.println("erro");
}
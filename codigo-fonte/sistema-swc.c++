const int sensorPin = 23; // Pino do sensor
volatile int pulseCount; // Variável volátil para contar os pulsos
unsigned long lastMillis;
const float pulsesPerLiter = 450.0; // Número de pulsos por litro
const int measurementInterval = 60000; // Intervalo de medição em milissegundos (60 segundos)

void IRAM_ATTR pulseCounter() {
  pulseCount++;
}

void setup() {
  Serial.begin(9600); // Inicializa a comunicação serial
  pinMode(sensorPin, INPUT_PULLUP); // Configura o pino do sensor como entrada com pull-up interno
  attachInterrupt(digitalPinToInterrupt(sensorPin), pulseCounter, RISING); // Configura a interrupção para contar os pulsos
  pulseCount = 0; // Inicializa o contador de pulsos
  lastMillis = millis(); // Inicializa o tempo da última leitura
}

void loop() {
  unsigned long currentMillis = millis();
  unsigned long elapsedTime = currentMillis - lastMillis;

  if (elapsedTime >= measurementInterval) { // Calcula a taxa de fluxo a cada minuto
    detachInterrupt(sensorPin); // Desativa a interrupção para evitar condições de corrida
    float flowRate = (pulseCount / pulsesPerLiter) / (measurementInterval / 60000.0); // Calcula a taxa de fluxo em litros por minuto
    Serial.print("Fluxo de água por minuto: ");
    Serial.print(flowRate);
    Serial.println(" L/min");
    pulseCount = 0; // Reinicia o contador de pulsos
    lastMillis = currentMillis; // Atualiza o tempo da última leitura
    attachInterrupt(digitalPinToInterrupt(sensorPin), pulseCounter, RISING); // Reativa a interrupção
  }
}

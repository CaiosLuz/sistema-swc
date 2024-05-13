<?php

class ConsumoAguaView {
    public function mostrarConsumo($consumoMinuto) {
        foreach ($consumoMinuto as $consumo) {
            echo "Consumo por Minuto: " . $consumo->getConsumo() . " L/M<br>";
        }
    }
}

?>
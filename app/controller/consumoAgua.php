<?php

class ConsumoAguaModels {
    private $id_medicao;
    private $litroMinuto;
    private $data_hora;

    public function __construct($id_medicao, $litroMinuto, $data_hora) {
        $this->id_medicao = $id_medicao;
        $this->litroMinuto = $litroMinuto;
        $this->data_hora = $data_hora;
    }

    public function getId(){
        return $this->id_medicao;
    }

    public function getData(){
        return $this->data_hora;
    }

    public function getConsumo(){
        return $this->litroMinuto;
    }

}

?>
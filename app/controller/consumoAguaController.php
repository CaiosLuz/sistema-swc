<?php 

require_once 'consumoAgua.php';

class ConsumoAguaController{
    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getConsumoAgua() {
        $consumoAguaList = [];
        $query = "SELECT * FROM medicoes";
        $stmt = $this->db->query($query);

        while($row = $stmt->fetch()){
            $consumoAgua = new ConsumoAguaModels($row['id_medicao'], $row['litroMinuto'], $row['data_hora']);
            $consumoAguaList[] = $consumoAgua; 
        }

        return $consumoAguaList;
    }

    public function getConsumoAguaDia() {
        $consumoAguaDia = [];
        $query = 'SELECT DATE(data_hora) as dia, SUM(litroMinuto) as totalLitros FROM medicoes GROUP BY dia';
        $stmt = $this->db->query($query);

        while ($row = $stmt->fetch()) {
            $consumoAguaDia[$row['dia']] = $row['totalLitros'];
        }

        return $consumoAguaDia;
    }
    
}

?>
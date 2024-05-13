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
        $dataAtual = date('Y-m-d');
        $query = 'SELECT SUM(litroMinuto) AS totalLitros FROM medicoes WHERE DATE(data_hora) = :dataAtual';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':dataAtual', $dataAtual, PDO::PARAM_STR);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado;
    }
    
}

?>
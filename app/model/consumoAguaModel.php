<?php

    class ConsumoAguaModel {
        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function getConsumoAguaPorPeriodo($range) {
            switch ($range) {
                case 'diario':
                    $query = "SELECT DATE(data_hora) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY label ORDER BY label";
                    break;
                case 'semanal':
                    $query = "SELECT YEAR(data_hora) AS year, WEEK(data_hora) AS week, CONCAT(YEAR(data_hora), '-W', WEEK(data_hora)) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY year, week ORDER BY year, week";
                    break;
                case 'mensal':
                    $query = "SELECT YEAR(data_hora) AS year, MONTH(data_hora) AS month, CONCAT(YEAR(data_hora), '-', LPAD(MONTH(data_hora), 2, '0')) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY year, month ORDER BY year, month";
                    break;
                case 'anual':
                    $query = "SELECT YEAR(data_hora) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY label ORDER BY label";
                    break;
                default:
                    return [];
            }

            $stmt = $this->db->query($query);
            $data = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }

            return $data;
        }

        public function getConsumoAguaDia() {
            $query = 'SELECT SUM(litroMinuto) AS totalLitros FROM medicoes WHERE DATE(data_hora) = CURDATE()';
            $stmt = $this->db->query($query);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado;
        }

    }

?>
<?php

    class ConsumoAguaModel {
        private $db;

        public function __construct($db){
            $this->db = $db;
        }

        public function getConsumoAguaPorPeriodo($range) {
            switch ($range) {
                case 'diario':
                    $query = "SELECT DATE_FORMAT(data_hora, '%d/%m') AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY DATE(data_hora) ORDER BY DATE(data_hora);";
                    break;
                case 'semanal':
                    $query = "SELECT YEAR(data_hora) AS year, WEEK(data_hora) AS week, CONCAT(WEEK(data_hora), ' - Semana ', YEAR(data_hora)) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY year, week ORDER BY year, week";
                    break;
                case 'mensal':
                    $query = "SELECT MONTH(data_hora) AS month, YEAR(data_hora) AS year, CONCAT(MONTH(data_hora), '-', LPAD(YEAR(data_hora), 4, '0')) AS label, SUM(litroMinuto) AS totalLitro FROM medicoes GROUP BY year, month ORDER BY year, month";
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
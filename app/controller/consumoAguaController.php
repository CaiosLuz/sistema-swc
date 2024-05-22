<?php 

    require_once '../model/consumoAgua.php';

    class ConsumoAguaController{
        private $model;

        public function __construct($db){
            $this->model = new ConsumoAguaModel($db);
        }

        public function getModel(){
            return $this->model;
        }

        public function handleRequest($action){
            switch ($action) {
                case 'consumoDia':
                    $data = $this->model->getConsumoAguaDia();
                    echo json_encode($data);
                    break;
                case 'consumoPeriodo':
                    $range = isset($_GET['range']) ? $_GET['range'] : 'diario';
                    $data = $this->model->getConsumoAguaPorPeriodo($range);
                    echo json_encode($data);
                    break;
                default:
                    echo json_encode([]);
                    break;
            }
        }
    }

    $config = include('../../config/database.php');
    $db = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);

    $controller = new ConsumoAguaController($db);
    $action = isset($_GET['action']) ? $_GET['action'] : 'consumoDia';
    $controller->handleRequest($action);

?>
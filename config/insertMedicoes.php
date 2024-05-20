<?php

    require_once './database.php';

    $config = include('database.php');

    try {
        $dbh = new PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        date_default_timezone_set('America/Sao_Paulo');

        $litroMinuto = isset($_POST['litroMinuto']) ? $_POST['litroMinuto'] : (isset($_GET['litroMinuto']) ? $_GET['litroMinuto'] : '');

        if (!empty($litroMinuto)) {
            $stmt = $dbh->prepare('INSERT INTO medicoes(litroMinuto, data_hora) VALUES (:litroMinuto, :data_hora)');
            $stmt->bindValue(':litroMinuto', $litroMinuto);
            $stmt->bindValue(':data_hora', date("Y-m-d H:i:s"));

            if ($stmt->execute()) {
                echo "Sucesso";
            } else {
                echo "Erro ao enserir dados";
            }
        } else {
            echo "Nenhum dado fornecido para litroMinuto";
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

?>
<?php

    return [
        'host' => 'localhost',
        'dbname' => 'sistemaSwc',
        'username' => 'root',
        'password' => '',
    ];

    date_default_timezone_set('America/Sao_Paulo');


    $litroMinuto = isset($_POST['litroMinuto']) ? $_POST['litroMinuto'] : (isset($_GET['litroMinuto']) ? $_GET['litroMinuto'] : '');

    $dbh;
    $stmt;

    $connStr = 'mysql:host=localhost;dbname=SistemaSwc';

    try {
        $dbh = new PDO($connStr, $username, $password);
    } catch (PDOException $e) {
        echo $e->getMessage();
        die();
    }

    $stmt = $dbh->prepare('INSERT INTO medicoes(litroMinuto, data_hora) VALUES (:litroMinuto, :data_hora)');

    $stmt->bindValue(':litroMinuto', $litroMinuto);
    $stmt->bindValue(':data_hora', date("Y-m-d H:i:s"));

    if ($stmt->execute()) {
        echo "Sucesso";
    } else {
        echo "Erro";
    }

?>
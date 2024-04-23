<?php

date_default_timezone_set('America/Sao_Paulo');

$litroMinuto = $_GET['litroMinuto'];

$dbh;
$stmt;

$connStr = 'mysql:host=localhost;dbname=SistemaSwc';

try {
    $dbh = new PDO($connStr, 'root', '');
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
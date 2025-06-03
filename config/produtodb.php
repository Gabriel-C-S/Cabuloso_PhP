<?php
$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

$insert = $pdo->query("INSERT INTO produto (nome) VALUES
(1, 'Xbox 360'),
(2, 'Playsation 5'),
(3, 'PC Ryzen'),
(4, 'FIFA 15'),
(5, 'Notebook Lenovo')");
?>
<?php
// Conexão com o banco de dados ao PHP
$database = 'pontodevenda';
$host = 'localhost';
$username = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, '');
    // Definindo o modo de erro do PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Não foi possível conectar ao banco: " . $e->getMessage();
    exit();
}
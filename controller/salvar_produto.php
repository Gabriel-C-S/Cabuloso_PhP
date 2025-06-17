<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/database.php';

// Verifica se os dados foram enviados corretamente
if (!isset($_POST['nome'], $_POST['preco'], $_POST['tipo'])) {
    die("Dados incompletos.");
}

$nome = $_POST['nome'];
$preco = floatval($_POST['preco']);
$tipo = $_POST['tipo'];

try {
    // Insere o novo produto no banco
    $stmt = $pdo->prepare("INSERT INTO produtos (nome, preco, tipo) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $preco, $tipo]);

    // Redireciona de volta para o painel ou lista
    header("Location: ../funcionario/painel.php");
} catch (Exception $e) {
    echo "Erro ao salvar produto: " . $e->getMessage();
}

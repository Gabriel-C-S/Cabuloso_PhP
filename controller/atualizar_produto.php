<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/database.php';

// Verifica se os dados foram enviados corretamente
if (!isset($_POST['id'], $_POST['nome'], $_POST['preco'], $_POST['tipo'])) {
    die("Dados incompletos.");
}

$id = intval($_POST['id']);
$nome = $_POST['nome'];
$preco = floatval($_POST['preco']);
$tipo = $_POST['tipo'];

try {
    // Atualiza os dados do produto com base no ID
    $stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, tipo = ? WHERE id = ?");
    $stmt->execute([$nome, $preco, $tipo, $id]);

    // Redireciona de volta ao painel
    header("Location: ../funcionario/painel.php");
} catch (Exception $e) {
    echo "Erro ao atualizar produto: " . $e->getMessage();
}

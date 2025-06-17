<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/database.php';

// Verifica se foi enviado o ID do produto
if (!isset($_GET['id'])) {
    die("ID do produto não especificado.");
}

$id = intval($_GET['id']);

try {
    // Deleta o produto com o ID correspondente
    $stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id]);

    // Redireciona para o painel após exclusão
    header("Location: ../funcionario/painel.php");
} catch (Exception $e) {
    echo "Erro ao excluir produto: " . $e->getMessage();
}

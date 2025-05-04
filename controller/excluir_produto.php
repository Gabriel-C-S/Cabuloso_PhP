<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/db.php';

//recupera o ID do produto a ser excluido por GET
$id = $_GET['id'] ?? 0; //se o ID não for fornecido, define como 0

//verifica se o ID é um numero vaalido
if (!is_numeric($id) || $id <= 0) {
    die("ID inválido.");
}

//tenta excluir o produto pelo ID
$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$stmt->execute([$id]);

//verifica se a exclusao foi bem-sucedida
if ($stmt->rowCount() > 0) {
    header("Location: ../funcionario/cadastrar_produto.php");
    exit;
} else {
    //caso o produto não tenha sido excluído
    echo "Erro ao excluir o produto.";
}


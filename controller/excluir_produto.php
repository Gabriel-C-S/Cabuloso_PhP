<?php
session_start();

//iniciará uma sessão do usuario com o funcionario para ser atendido
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

//aqui será incluido o arquivo do banco de dados em php
include '../config/db.php';

//recupera o ID do produto a ser excluido por GET
$id = $_GET['id'] ?? 0; //se o ID não for fornecido, define como 0, ou o id não começara com um numero

//verifica se o ID é um numero valido
if (!is_numeric($id) || $id <= 0) {
    //se o id for menor que 0, contará como um id inválido
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


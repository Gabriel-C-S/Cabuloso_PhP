<?php
session_start();

//impede acesso direto sem login
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/db.php'; //conecta com banco

//recebe os dados do formulário
$nome = $_POST['nome'];
$preco = $_POST['preco'];
$tipo = $_POST['tipo'];

//inserção no banco de dados
$sql = "INSERT INTO produtos (nome, preco, tipo) VALUES (?, ?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$nome, $preco, $tipo]);

//volta para o formulário depois salvar
header("Location: ../funcionario/cadastrar_produto.php");

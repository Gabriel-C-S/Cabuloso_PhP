<?php
session_start();
include '../config/database.php';

// Verifica se os campos foram enviados
if (!isset($_POST['usuario']) || !isset($_POST['senha'])) {
    die("Usuário ou senha não enviados.");
}

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

// Consulta o banco buscando o funcionário
$stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE usuario = ?");
$stmt->execute([$usuario]);
$funcionario = $stmt->fetch();

if ($funcionario && password_verify($senha, $funcionario['senha'])) {
    // Se o usuário existe e a senha está correta
    $_SESSION['usuario'] = $funcionario['usuario'];
    header("Location: ../funcionario/painel.php");
} else {
    // Falha na autenticação
    echo "Usuário ou senha inválidos.";
    echo "<br><a href='../funcionario/login.php'>← Tentar novamente</a>";
}

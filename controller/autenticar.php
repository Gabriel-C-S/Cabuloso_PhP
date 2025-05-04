<?php
session_start();
include '../config/db.php';

//recupera os dados do formulario
$usuario = $_POST['usuario'] ?? null; //verifica se 'usuario' foi preenchido
$senha = $_POST['senha'] ?? null; //verifica se'senha' foi prenchido

//valida se os campos foram preenchidos
if (!$usuario || !$senha) {
    die("Usuário e senha são obrigatórios.");
}

//executa a consulta no banco para buscar o usuario
$sql = "SELECT * FROM usuarios WHERE usuario = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario]);
$usuarioBD = $stmt->fetch();

//verifica se o usuario existe e se a senha esta correta
if ($usuarioBD && password_verify($senha, $usuarioBD['senha'])) {
    //salva os dados do usuario na sessao
    $_SESSION['usuario'] = $usuarioBD['nome'];
    $_SESSION['tipo'] = $usuarioBD['tipo'];

    //redireciona para o painel do funcionario
    header("Location: ../funcionario/painel.php");
    exit;
} else {
    //se usuário ou senha sejam errados
    echo "Usuário ou senha inválidos.";
}


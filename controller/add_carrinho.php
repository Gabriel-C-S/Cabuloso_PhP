<?php
session_start();

// Verifica se foi enviado o ID do produto
if (!isset($_POST['id'])) {
    die("Produto inválido.");
}

$id = intval($_POST['id']); // Garante que o ID seja um número inteiro

// Inicializa o carrinho se ainda não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Se o produto já estiver no carrinho, incrementa a quantidade
if (isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id]++;
} else {
    $_SESSION['carrinho'][$id] = 1;
}

// Redireciona de volta para a loja
header("Location: ../cliente/index.php");

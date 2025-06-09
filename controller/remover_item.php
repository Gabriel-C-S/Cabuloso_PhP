<?php
session_start();

// Verifica se foi enviado o ID do produto
if (!isset($_GET['id'])) {
    die("Produto não especificado.");
}

$id = intval($_GET['id']); // Garante que o ID seja numérico

// Verifica se o item existe no carrinho antes de remover
if (isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}

// Redireciona de volta para o carrinho
header("Location: ../cliente/carrinho.php");

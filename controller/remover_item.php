<?php
session_start();

$id = $_GET['id'] ?? null;
//pega o id do item e remove
if ($id && isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}

header("Location: ../cliente/carrinho.php");

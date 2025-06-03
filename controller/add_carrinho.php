<?php
session_start();

include "..config/produtodb.php";

$id = $_POST['id'] ?? null; //recupera o ID do produto enviado via POST

//se nao houver ID valido, interrompe a execuçao e exibe uma mensagem
if (!$id) {
    die("ID inválido.");
}

//consulta o produto no banco
$stmt = $pdo->prepare("SELECT estoque, tipo FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch();

//se for produto e o estoque for 0, nao permite adicionar ao carrinho
if ($produto['tipo'] == 'produto' && $produto['estoque'] <= 0) {
    die("Produto fora de estoque.");
}

//adiciona o produto ao carrinho
if (!isset($_SESSION['carrinho'][$id])) {
    $_SESSION['carrinho'][$id] = 1; //se não tiver no carrinho, coloca com quantidade 1
} else {
    $_SESSION['carrinho'][$id]++; //se jativer, a quantidade
}

//mANDA PRA PÁGINA INICAL
header("Location: ../cliente/index.php");
exit;

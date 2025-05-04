<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/db.php';

//pega os IDs dos produtos selecionados para a venda
$produtosSelecionados = $_POST['produtos'] ?? [];

if (empty($produtosSelecionados)) {
    die("Nenhum produto selecionado.");
}

try {
    $pdo->beginTransaction(); //inicia a transação

    $total = 0;
    $dadosProdutos = [];

    //busca os dados dos produtose calcula o total
    foreach ($produtosSelecionados as $id) {
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $preco = $stmt->fetchColumn();

        if ($preco !== false) {
            $total += $preco;
            $dadosProdutos[] = ['id' => $id, 'preco' => $preco];
        }
    }

    //registra a venda e pega o ID
    $stmt = $pdo->prepare("INSERT INTO vendas (total) VALUES (?)");
    $stmt->execute([$total]);
    $vendaId = $pdo->lastInsertId();

    //registra os itens da venda
    foreach ($dadosProdutos as $p) {
        $stmt = $pdo->prepare("INSERT INTO itens_venda (venda_id, produto_id, preco_unitario) VALUES (?, ?, ?)");
        $stmt->execute([$vendaId, $p['id'], $p['preco']]);
    }

    $pdo->commit(); //confirmano banco

    //redireciona de volta ao pdv
    header("Location: ../funcionario/pdv.php");
} catch (Exception $e) {
    $pdo->rollBack(); //dsfaz tudo em caso de erro
    die("Erro ao finalizar venda: " . $e->getMessage());
}

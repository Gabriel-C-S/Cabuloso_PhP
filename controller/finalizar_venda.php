<?php
session_start();

// Garante que só funcionário logado pode acessar essa página
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '../config/db.php'; // Conexão com o banco

// Recebe os IDs dos produtos selecionados no PDV (formulário)
$produtosSelecionados = $_POST['produtos'] ?? [];

if (empty($produtosSelecionados)) {
    die("Nenhum produto selecionado.");
}

try {
    $pdo->beginTransaction(); // Inicia transação para garantir integridade

    $total = 0;
    $dadosProdutos = [];

    // Para cada produto selecionado, busca o preço e soma ao total
    foreach ($produtosSelecionados as $id) {
        $stmt = $pdo->prepare("SELECT preco FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $preco = $stmt->fetchColumn();

        if ($preco !== false) {
            $total += $preco;
            // Armazena dados para inserir os itens depois
            $dadosProdutos[] = ['id' => $id, 'preco' => $preco];
        }
    }

    // Insere a venda na tabela vendas e obtém o ID gerado
    $stmt = $pdo->prepare("INSERT INTO vendas (total) VALUES (?)");
    $stmt->execute([$total]);
    $vendaId = $pdo->lastInsertId();

    // Insere os produtos vendidos na tabela itens_venda
    foreach ($dadosProdutos as $p) {
        $stmt = $pdo->prepare("INSERT INTO itens_venda (venda_id, produto_id, preco_unitario) VALUES (?, ?, ?)");
        $stmt->execute([$vendaId, $p['id'], $p['preco']]);
    }

    $pdo->commit(); // Confirma a transação

    // Redireciona de volta para a página do PDV
    header("Location: ../funcionario/pdv.php");

} catch (Exception $e) {
    $pdo->rollBack(); // Em caso de erro, desfaz todas as alterações
    die("Erro ao finalizar venda: " . $e->getMessage());
}
?>

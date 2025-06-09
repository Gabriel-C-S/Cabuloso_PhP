<?php
session_start();

include '../config/db.php'; // conecta com o banco

// Verifica se o carrinho existe e não está vazio, e se os dados do cliente foram enviados via POST
if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho']) || 
    !isset($_POST['nome']) || !isset($_POST['contato'])) {
    echo "Carrinho vazio ou dados do cliente ausentes.";
    exit;
}

$carrinho = $_SESSION['carrinho']; // pega o carrinho da sessão
$nome = $_POST['nome'];             // nome do cliente enviado no formulário
$contato = $_POST['contato'];       // contato do cliente enviado no formulário
$total = 0;                        // variável para calcular o total do pedido

// Pega todos os IDs do carrinho para buscar seus preços no banco
$ids = implode(',', array_map('intval', array_keys($carrinho)));

// Busca os produtos cadastrados no banco com esses IDs
$query = $pdo->query("SELECT id, preco FROM produtos WHERE id IN ($ids)");
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);

// Calcula o total multiplicando preço pela quantidade de cada produto no carrinho
foreach ($produtos as $p) {
    $id = $p['id'];
    $quantidade = $carrinho[$id]; // quantidade daquele produto no carrinho
    $total += $p['preco'] * $quantidade; // soma ao total
}

try {
    $pdo->beginTransaction(); // inicia a transação para garantir integridade

    // Insere a venda na tabela vendas com os dados do cliente e total calculado
    $stmt = $pdo->prepare("INSERT INTO vendas (nome_cliente, contato_cliente, total, data) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$nome, $contato, $total]);
    $venda_id = $pdo->lastInsertId(); // pega o id da venda inserida

    // Prepara o insert dos itens da venda na tabela itens_venda
    $stmt_item = $pdo->prepare("INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");

    // Para cada produto, insere um registro na tabela itens_venda com a quantidade e preço unitário
    foreach ($produtos as $p) {
        $id = $p['id'];
        $quantidade = $carrinho[$id];
        $preco_unitario = $p['preco'];
        $stmt_item->execute([$venda_id, $id, $quantidade, $preco_unitario]);
    }

    $pdo->commit(); // confirma a transação no banco

    unset($_SESSION['carrinho']); // limpa o carrinho da sessão

    // Mensagem de sucesso e link para voltar para o início do site
    echo "<h2>Pedido realizado com sucesso!</h2>";
    echo "<a href='../index.php'>← Voltar ao início</a>";

} catch (Exception $e) {
    $pdo->rollBack(); // desfaz a transação em caso de erro
    echo "Erro ao finalizar pedido: " . $e->getMessage();
}
?>

<?php
session_start();
include '../config/db.php';

//recebe os dados do usuario
$nome = $_POST['nome'] ?? 'Cliente'; //caso o nome não seja dado
$contato = $_POST['contato'] ?? '';  //caso o contato não seja informado deixa vazio

//berifica se o carrinho está vazio
$carrinho = $_SESSION['carrinho'] ?? []; //recupera o carrinho da sessao

if (empty($carrinho)) {
    die("Carrinho vazio. Não é possível finalizar um pedido sem itens.");
}

//inicia a tranzação no banco
$pdo->beginTransaction();

try {
    //cria o registro da venda
    $stmt = $pdo->prepare("INSERT INTO vendas (total, nome_cliente, contato_cliente) VALUES (?, ?, ?)");
    $stmt->execute([0, $nome, $contato]); //inicia com total = 0
    $vendaId = $pdo->lastInsertId(); //poega o ID da venda gerada

    $total = 0; //variavel para calcular o total da venda

    //processa cada item do carrinho
    foreach ($carrinho as $id => $qtd) {
        //recupera os detalhes do produto
        $stmt = $pdo->prepare("SELECT preco, tipo, estoque FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch();

        //registra cada item vendid
        $stmt = $pdo->prepare("INSERT INTO itens_venda (venda_id, produto_id, quantidade, preco_unitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$vendaId, $id, $qtd, $p['preco']]);

        //atualiza o estoque
        if ($p['tipo'] == 'produto') {
            $novoEstoque = $p['estoque'] - $qtd;
            $novoEstoque = max($novoEstoque, 0); //garante que o estoque não seja negativo

            $stmt = $pdo->prepare("UPDATE produtos SET estoque = ? WHERE id = ?");
            $stmt->execute([$novoEstoque, $id]);
        }

        //clcula o total do pedido
        $total += $p['preco'] * $qtd;
    }

    //atualiza o total da venda
    $stmt = $pdo->prepare("UPDATE vendas SET total = ? WHERE id = ?");
    $stmt->execute([$total, $vendaId]);

    //confirma a transação
    $pdo->commit();

    //limpa o carrinho no fim
    $_SESSION['carrinho'] = [];

    //mensagem de sucesso
    echo "Pedido realizado com sucesso!";
    echo "<br><a href='../cliente/index.php'>← Voltar à loja</a>";
} catch (Exception $e) {
    //caso ocorra algum erro desfaz o pedido
    $pdo->rollBack();
    echo "Erro ao finalizar o pedido: " . $e->getMessage();
}

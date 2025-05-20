<?php
session_start(); //inicia a sessão para acessar o carrinho
include '../config/db.php'; //conecta com o banco

//recupera o carrinho da sessão, ou um array vazio se não existir
//ao iniciar uma sessão, a espressão abaixo verificará se o carrinho está cheio. se sim, retorna ele cheio, se não retorna o carrinho(array) vazio
$carrinho = $_SESSION['carrinho'] ?? [];

$total = 0; //variável para somar o valor total do carrinho

echo "<h2>Seu Carrinho</h2>";

//empty verifica que o carrinho está vazio
if (empty($carrinho)) {
    //se não houver itens, exibe mensagem
    echo "Carrinho vazio.<br>";
} else {
    //para cada item no carrinho (id do produto => quantidade)
    foreach ($carrinho as $id => $qtd) {
        //busca o produto no banco
        $stmt = $pdo->prepare("SELECT nome, preco FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $p = $stmt->fetch();

        //calcula subtotal e soma ao total
        $subtotal = $p['preco'] * $qtd;
        $total += $subtotal;

        //exibe o produto e subtotal formatado
        echo "{$p['nome']} - R$ {$p['preco']} x $qtd = R$ " . number_format($subtotal, 2, ',', '.') . "<br>";
        echo "<a href='../controllers/remover_item.php?id=$id'>Remover</a><br><br>";
    }

    //exibe o total
    echo "<strong>Total: R$ " . number_format($total, 2, ',', '.') . "</strong><br><br>";

    //formulário de finalização de pedido
    echo '
    <form method="POST" action="../controllers/finalizar_pedido.php">
        Nome: <input name="nome" required><br><br>
        Contato (ex: WhatsApp ou e-mail): <input name="contato" required><br><br>
        <button type="submit">Finalizar Pedido</button>
    </form>
    ';
}

//link para voltar à página de produtos
echo "<br><a href='index.php'>← Continuar comprando</a>";

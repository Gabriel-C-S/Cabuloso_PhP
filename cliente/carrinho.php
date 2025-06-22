<?php
session_start(); // Inicia a sessão para acessar o carrinho

// Verifica se o carrinho existe na sessão; se não, cria um carrinho vazio
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

include '../config/database.php'; // Conecta ao banco de dados

$carrinho = $_SESSION['carrinho']; // Pega os produtos do carrinho
$total = 0;

// Se o carrinho estiver vazio, mostra mensagem e botão de voltar

// Coleta os IDs dos produtos no carrinho
if (empty($carrinho)) {
    echo "<p>Seu carrinho está vazio.</p>";
    echo "<a href='index.php'>← Voltar ao início</a>";
    exit;
}
$ids = implode(',', array_keys($carrinho));

// Busca os dados dos produtos no banco usando os IDs do carrinho
$query = $pdo->query("SELECT * FROM produto WHERE id IN ($ids)");
$produtos = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<a href='index.php'>← Voltar às compras</a>
<h2>Seu Carrinho</h2>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>Produto</th>
    <th>Preço</th>
    <th>Quantidade</th>
    <th>Subtotal</th>
    <th>Ação</th>
  </tr>

  <?php foreach ($produtos as $produto): 
    $id = $produto['id'];
    $quantidade = $carrinho[$id]; // Quantidade escolhida
    $subtotal = $produto['preco'] * $quantidade;
    $total += $subtotal;
  ?>
    <tr>
      <td><?= htmlspecialchars($produto['nome']) ?></td>
      <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
      <td><?= $quantidade ?></td>
      <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
      <td>
        <!-- Link para remover item do carrinho -->
        <a href="../controllers/remover_item.php?id=<?= $id ?>">Remover</a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<br>
<strong>Total Geral:</strong> R$ <?= number_format($total, 2, ',', '.') ?>

<br><br>
<!-- Botão para voltar às compras -->
<a href="index.php">← Continuar comprando</a>

<!-- Botão para finalizar o pedido -->
<br><br>
<a href="cadastro_cliente.php"><button>Finalizar Pedido</button></a>

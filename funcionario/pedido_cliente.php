<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
include '../config/db.php';

// Consulta todas as vendas realizadas por clientes
$vendas = $pdo->query("SELECT * FROM vendas WHERE nome_cliente IS NOT NULL ORDER BY data DESC")->fetchAll();
?>

<h2>Pedidos Realizados por Clientes</h2>

<?php
// exibe as informações de cada venda recuperada da consulta
foreach ($vendas as $venda): ?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
    <!--exibe as informaçoes da venda -->
    <strong>Cliente:</strong> <?= htmlspecialchars($venda['nome_cliente']) ?> <br>
    <strong>Contato:</strong> <?= htmlspecialchars($venda['contato_cliente']) ?> <br>
    <!--formata a data da venda -->
    <strong>Data:</strong> <?= date('d/m/Y H:i', strtotime($venda['data'])) ?> <br>
    <!--exibe o total da venda com formataçao de moeda -->
    <strong>Total:</strong> R$ <?= number_format($venda['total'], 2, ',', '.') ?> <br>
    <strong>Itens:</strong><br>

    <ul>
    <?php
      //prepara a consulta para obter os itens da venda (produtos comprados)
      $stmt = $pdo->prepare("
        SELECT p.nome, iv.quantidade, iv.preco_unitario
        FROM itens_venda iv
        JOIN produtos p ON iv.produto_id = p.id
        WHERE iv.venda_id = ?
      ");
      //executa a consulta passando o ID da venda
      $stmt->execute([$venda['id']]);
      //recupera todos os itens da venda
      $itens = $stmt->fetchAll();

      //para cada item da venda, exibe o nome, quantidade e preço unitario
      foreach ($itens as $item):
    ?>
      <li>
        <!--exibe as informações do item da venda-->
        <?= htmlspecialchars($item['nome']) ?> - <?= $item['quantidade'] ?> x R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?>
      </li>
    <?php endforeach; ?>
    </ul>
  </div>
<?php endforeach; ?>

<a href="painel.php">← Voltar ao painel</a>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

//consulta vendas, da mais nova para a mais antiga
$vendas = $pdo->query("SELECT * FROM vendas ORDER BY data DESC")->fetchAll();
?>

<h2>Relatório de Vendas</h2>

<?php foreach ($vendas as $venda): ?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
    <strong>Venda ID:</strong> <?= $venda['id'] ?> <br>
    <strong>Data:</strong> <?= $venda['data'] ?> <br>
    <strong>Total:</strong> R$ <?= number_format($venda['total'], 2, ',', '.') ?> <br>
    <strong>Itens:</strong><br>

    <ul>
    <?php
      //busca os itens dessa venda
      $stmt = $pdo->prepare("
        SELECT p.nome, iv.preco_unitario
        FROM itens_venda iv
        JOIN produtos p ON iv.produto_id = p.id
        WHERE iv.venda_id = ?
      ");
      $stmt->execute([$venda['id']]);
      $itens = $stmt->fetchAll();

      foreach ($itens as $item):
    ?>
      <li><?= $item['nome'] ?> - R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></li>
    <?php endforeach; ?>
    </ul>
  </div>
<?php endforeach; ?>

<a href="painel.php">← Voltar ao painel</a>

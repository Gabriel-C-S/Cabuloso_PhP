<?php
session_start(); // Inicia a sessão para uso do carrinho
include '../config/clientedb.php'; // Conexão com o banco de dados

// Cria o carrinho se ele ainda não existir na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Busca todos os produtos e serviços cadastrados, ordenados por nome
$produtos = $pdo->query("SELECT * FROM produtos ORDER BY nome")->fetchAll();
?>

<h2>Bem-vindo ao Cabuloso Eletronics</h2>

<!-- Exibe todos os produtos/serviços com botão de adicionar -->
<?php foreach ($produtos as $p): ?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px;">
    <strong><?= htmlspecialchars($p['nome']) ?></strong><br>
    R$ <?= number_format($p['preco'], 2, ',', '.') ?> (<?= htmlspecialchars($p['tipo']) ?>)<br>

    <!-- Botão para adicionar ao carrinho -->
    <form method="POST" action="../controllers/add_carrinho.php">
      <input type="hidden" name="id" value="<?= $p['id'] ?>">
      <button type="submit">Adicionar ao carrinho</button>
    </form>
  </div>
<?php endforeach; ?>

<!-- Links úteis -->
<a href="carrinho.php">Ver Carrinho</a>
<a href="../login.php" style="font-size: small; float: right;">Área do Funcionário</a>

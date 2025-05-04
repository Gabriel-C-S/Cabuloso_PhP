<?php
session_start(); //inicia a sessão para gerenciar o carrinho
include '../config/db.php'; //conexão com o banco

//cria o carrinho na sessão, se ainda não existir
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

//busca todos os produtos e serviços do banco, ordenados por nome
$produtos = $pdo->query("SELECT * FROM produtos ORDER BY nome")->fetchAll();
?>

<h2>Bem-vindo à Loja</h2>

<!--exibe todos os produtos/serviços-->
<?php foreach ($produtos as $p): ?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px;">
    <strong><?= htmlspecialchars($p['nome']) ?></strong><br>
    R$ <?= number_format($p['preco'], 2, ',', '.') ?> (<?= $p['tipo'] ?>)<br>

    <!--botão para adicionar ao carrinho-->
    <form method="POST" action="../controllers/add_carrinho.php">
      <input type="hidden" name="id" value="<?= $p['id'] ?>">
      <button type="submit">Adicionar ao carrinho</button>
    </form>
  </div>
<?php endforeach; ?>

<!--links úteis-->
<a href="carrinho.php">Ver Carrinho</a>
<a href="../login.php" style="font-size: small; float: right;">Área do Funcionário</a>


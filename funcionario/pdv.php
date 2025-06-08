<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../config/produtodb.php';

//busca produtos e serviços cadastrados
$produtos = $pdo->query("SELECT * FROM produtos ORDER BY nome")->fetchAll();
?>

<h2>PDV - Registrar Venda</h2>

<form method="POST" action="../controllers/finalizar_venda.php">
    <h3>Selecione os Produtos/Serviços</h3>
    <?php foreach ($produtos as $p): ?>
        <label>
            <input type="checkbox" name="produtos[]" value="<?= $p['id'] ?>">
            <?= $p['nome'] ?> - R$ <?= number_format($p['preco'], 2, ',', '.') ?> (<?= $p['tipo'] ?>)
        </label><br>
    <?php endforeach; ?>
    
    <br>
    <button type="submit">Finalizar Venda</button>
</form>

<a href="painel.php">← Voltar ao painel</a>

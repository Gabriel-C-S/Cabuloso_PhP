<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); //garante que só funcionários logados vejam
    exit;
}

include '../config/db.php';

//pega datas do formulário (se enviadas), senão usa hoje
$data_inicio = $_GET['inicio'] ?? date('Y-m-01'); //primeiro dia do mês atual
$data_fim = $_GET['fim'] ?? date('Y-m-d'); // Hoje

//consulta vendas no intervalo de datas
$stmt = $pdo->prepare("SELECT * FROM vendas WHERE data BETWEEN ? AND ? ORDER BY data DESC");
$stmt->execute([$data_inicio . " 00:00:00", $data_fim . " 23:59:59"]);
$vendas = $stmt->fetchAll();
?>

<h2>Relatório de Vendas</h2>

<!--formulário para selecionar intervalo -->
<form method="GET">
  De: <input type="date" name="inicio" value="<?= $data_inicio ?>">
  Até: <input type="date" name="fim" value="<?= $data_fim ?>">
  <button type="submit">Filtrar</button>
</form>

<br>

<?php
$total_geral = 0; //inicializa total

foreach ($vendas as $venda):
    $total_geral += $venda['total']; //soma o total de cada venda
?>
  <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
    <strong>Data:</strong> <?= $venda['data'] ?><br>
    <strong>Cliente:</strong> <?= $venda['nome_cliente'] ?? '---' ?><br>
    <strong>Total:</strong> R$ <?= number_format($venda['total'], 2, ',', '.') ?><br>
  </div>
<?php endforeach; ?>

<!--exibe o total somado -->
<strong>Total no período:</strong> R$ <?= number_format($total_geral, 2, ',', '.') ?><br><br>

<a href="painel.php">← Voltar ao painel</a>

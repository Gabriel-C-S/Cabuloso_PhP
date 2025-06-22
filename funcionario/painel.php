<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}
?>

<!-- painel do funcionário -->
<h2>Bem-vindo, <?php echo $_SESSION['usuario']; ?>!</h2>

<!--logout -->
<a href="logout.php">Sair</a>

<ul>
  <li><a href="cadastrar_produto.php">Cadastrar Produtos/Serviços</a></li>
  <li><a href="pdv.php">Registrar Venda</a></li>
  <li><a href="relatorio_vendas.php">Relatório de Vendas</a></li>
  <a href="relatorio.php">Relatório por Data</a>
  <li><a href="pedidos_clientes.php">Pedidos de Clientes</a></li>
  <li><a href="relatorio.php">Relatório de Vendas</a></li>
  <a href="logout.php">Sair</a>

</ul>

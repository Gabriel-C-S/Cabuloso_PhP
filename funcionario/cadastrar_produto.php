<?php
session_start();
?>

<!--formulario para cadastrar produto ou serviço -->
<h2>Cadastrar Produto ou Serviço</h2>

<form method="POST" action="">
  <!--campo para nome do produto/serviço -->
  Nome: <input name="nome" required><br><br>

  <!--campo para o preço -->
  Preço: <input name="preco" type="number" step="0.01" required><br><br>

  <!--seleção do tipo: produto ou serviço -->
  Tipo: 
  <select name="tipo">
    <option value="produto">Produto</option>
    <option value="serviço">Serviço</option>
  </select><br><br>

  <!--botão para enviar o formulario -->
  <button type="submit">Salvar</button>
</form>

<!--link para voltar ao painel do funcionario -->
<a href="painel.php">← Voltar ao painel</a>

<?php
include '../config/database.php'; //conecta ao banco de dados

//consulta todos os produtos e serviços, ordenando por id
$produtos = $pdo->query("SELECT * FROM produto ORDER BY id DESC")->fetchAll();

//mostra lista de produtos e serviços cadastrados
echo "<h3>Produtos/Serviços Cadastrados:</h3>";
foreach ($produtos as $p) {
    echo "{$p['nome']} - R$ {$p['preco']} {$p['tipo']}<br>";
    echo "<a href='editar_produto.php?id={$p['id']}'>[Editar]</a> ";
    echo "<a href='../controllers/excluir_produto.php?id={$p['id']}' onclick='return confirm(\"Tem certeza?\")'>[Excluir]</a>";
    echo "<br>";
}
?>


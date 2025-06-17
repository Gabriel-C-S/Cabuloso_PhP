<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

include '../config/database.php';s

//pega o ID do produto a ser editado da URL
$id = $_GET['id'] ?? 0; //caso o 'id' não exista, define 0 como padrão

//busca o produto no banco
$stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = ?");
$stmt->execute([$id]);
$produto = $stmt->fetch(); // Recupera os dados do produto

//caso não seja encontrado
if (!$produto) {
    die("Produto não encontrado.");
}
?>

<!--formulário de edição do produto/serviço-->
<h2>Editar Produto/Serviço</h2>

<form method="POST" action="../controllers/atualizar_produto.php">
  <!--envia o ID do produto como campo oculto -->
  <input type="hidden" name="id" value="<?= $produto['id'] ?>">

  <!--campo para editar o nome do produto -->
  Nome: <input name="nome" value="<?= $produto['nome'] ?>" required><br><br>

  <!--campo para editar o preço do produto -->
  Preço: <input name="preco" type="number" step="0.01" value="<?= $produto['preco'] ?>" required><br><br>

  <!--campo para selecionar o tipo de produto ou serviço -->
  Tipo: 
  <select name="tipo">
    <!--verifica qual tipo está selecionado e marca como 'selected' -->
    <option value="produto" <?= $produto['tipo'] == 'produto' ? 'selected' : '' ?>>Produto</option>
    <option value="serviço" <?= $produto['tipo'] == 'serviço' ? 'selected' : '' ?>>Serviço</option>
  </select><br><br>

  <!--botão para salvar -->
  <button type="submit">Salvar Alterações</button>
</form>
<a href="cadastrar_produto.php">← Voltar</a>

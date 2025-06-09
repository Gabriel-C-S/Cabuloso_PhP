<?php
session_start();

// Se o formulário foi enviado (POST), salva os dados do cliente na sessão
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['cliente_nome'] = $_POST['nome'];
    $_SESSION['cliente_contato'] = $_POST['contato'];

    // redireciona para finalizar o pedido
    header("Location: finalizar_pedido.php");
    exit;
}
?>

<h2>Cadastro do Cliente</h2>

<form method="POST">
  <!-- nome do cliente -->
  Nome: <input type="text" name="nome" required><br><br>

  <!-- contatos do cliente  -->
  Contato: <input type="text" name="contato" required><br><br>

  <button type="submit">Continuar</button>
</form>

<a href="carrinho.php">← Voltar ao carrinho</a>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: ../funcionario/login.php");
    exit;
}

include '..config/produtodb.php'

//valida os dados recebidos via POST
$id = $_POST['id'] ?? null;
$nome = $_POST['nome'] ?? null;
$preco = $_POST['preco'] ?? null;
$tipo = $_POST['tipo'] ?? null;

//verifica se todos os campos estao preenchidos
//die: retorna uma exibição de uma mensagem opcional 
if (!$id && !$nome && !$preco && !$tipo) {
    die("Todos os campos são obrigatórios.");
    //echo("Todos os campos são obrigatórios.");
}

//evita modificação de dados ou ataques no banco de dados.

$nome = htmlspecialchars($nome);
$preco = filter_var($preco, FILTER_VALIDATE_FLOAT); //valida se o preço é um número flutuante
$tipo = htmlspecialchars($tipo);

//atualiza o banco
$stmt = $pdo->prepare("UPDATE produtos SET nome = ?, preco = ?, tipo = ? WHERE id = ?");
$stmt->execute([$nome, $preco, $tipo, $id]);

//redireciona para o cadastro de produtos
header("Location: ../funcionario/cadastrar_produto.php");
exit;

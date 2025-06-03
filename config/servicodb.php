<?php
$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

$insert = $pdo->query("INSERT INTO servico (id, id_funcionario, id_cliente, id_produto, nome, descricao, preco, pecas_utilizadas, tempo estimado) VALUES
(),
(),
(),
(),
();");
?>
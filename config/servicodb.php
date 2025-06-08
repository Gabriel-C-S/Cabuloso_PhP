<?php
$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

//Aqui podem dar continuidade às inserts de serviço
$cmd = $pdo->query("INSERT INTO servico (id, id_funcionario, id_cliente, id_produto, nome, descricao, preco, pecas_utilizadas, tempo estimado) VALUES
(1, 1, 3, 2, 'Concerto', 'Em Andamento', 200, '', 'Duas Semanas'),
(2, 3, 1, 3, 'Concerto', 'Finalizado', 200, '', 'Zero Dias'),
(2, 2, 2, 1, '', '', , '', ''),
(),
();");

//Aqui dêem inicio ao Select de uma coluna dessa tabela, pode ser qualquer uma
?>
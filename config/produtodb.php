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
$cmd = $pdo->query("INSERT INTO servico (id, id_funcionario, id_cliente, id_produto, nome, 
descricao, preco, pecas_utilizadas, tempo estimado) VALUES
(1, 1, 3, 2, 'Conserto', 'Em Andamento', 200, '', 'Sete Dias'),
(2, 3, 1, 3, 'Conserto', 'Finalizado', 200, '', 'Zero Dias'),
(3, 3, 2, 2, 'Conserto', 'Finalizado', 250, '', 'Zero Dias'),
(4, 2, 1, 4, 'Troca', 'Em Andamento', 100, '', 'Quatorze Dias'),
(5, 2, 3, 4, 'Troca', 'Finalizado', 200, '', 'Um dia');");

//Aqui dêem inicio ao Select de uma coluna dessa tabela, pode ser qualquer uma

$cmd = $pdo->prepare("SELECT * FROM servico WHERE id='1'");
$cmd->bindValues(':id',1);
$cmd->execute();
$resultado=$cmd->fetch(PDO::FETCH_ASSOC);

foreach($resultado as $key => $value){
    echo $key.":".$value."<br>";
}

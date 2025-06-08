<?php
//Conexão com o banco de dados ao php

$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

//Inserção de dados usando o método query

$cmd = $pdo-query("INSERT INTO funcionario (id, nome, telefone, email, rg, cpf) VALUES
(1 , 'Alisson Ruan', '12341233', 'alisson@gmail.com', '2342134', '234231'),
(2 ,'Ana Karoline', '234234423', 'anakaroline@gmail.com', '423422423', '2342341'),
(3, 'Arthur Ramos', '242314213', 'arthurramos@gmail.com', '23423423', '42342323'),
(4, 'Gabriel Clayton', '234234234', 'jeffersonferreira@gmail.com', '23421343', '3734463'),
(5, 'Jefferson Ferreira', '79872938', 'gabrielclayton@gmail.com', '723942', '287492323')");

//Seleção de uma coluna específica de uma tabela através do id e executando por meio do foreach

$cmd = $pdo->prepare("SELECT * FROM funcionario WHERE id='4'");
$cmd->bindValues(':id',4);
$cmd->execute();
$resultado=$cmd->fetch(PDO::FETCH_ASSOC);

foreach ($resultado as $key => $value) {
    echo $key.":".$value."<br>";
}
?>
<?php
$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

$insert = $pdo-query("INSERT INTO funcionario (id, nome, telefone, email, rg, cpf) VALUES
(1 , 'Alisson Ruan', '12341233', 'alisson@gmail.com', '2342134', '234231'),
(2 ,'Ana Karoline', '234234423', 'anakaroline@gmail.com', '423422423', '2342341'),
(3, 'Arthur Ramos', '242314213', 'arthurramos@gmail.com', '23423423', '42342323'),
(4, 'Gabriel Clayton', '234234234', 'jeffersonferreira@gmail.com', '23421343', '3734463'),
(5, 'Jefferson Ferreira', '79872938', 'gabrielclayton@gmail.com', '723942', '287492323')");
?>
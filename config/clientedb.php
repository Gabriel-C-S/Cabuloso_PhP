<?php
//Conexão com o banco de dados ao php

$database = 'pontodevenda';
$host = 'localhost';
$username = 'root';

try{
    $pdo = new PDO ("mysql:database=$database;host=$host");
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

$insert = $pdo->query ("INSERT INTO cliente (id, nome, telefone, endereco, rg, cpf, email) VALUES
(1 'Joaquin', '00000000', 'Avenida Paulista', '4234231', '22342134', 'joaquin@gmail.com'), 
(2 'Jefferson', '11111111', 'José Bonifacio', '12343323', '3421341', 'jefferson@gmail.com'),
(3 'Pedro', '22222222', 'Antonio Silvio Cunha Bueno', '123123', '2341324', 'pedro@gmail.com'),
(4 'Paula', '33333333', 'Rua dos Botocudos', '24234213', '2342134', 'paula@gmail.com'),
(5 'Maria', '44444444', 'Avenida Rio de Janeiro', '223432', '24234', 'maria@gmail.com')");

//Seleção de uma coluna específica de uma tabela através do id e executando por meio do foreach

$insert = $pdo->prepare("SELECT * FROM cliente WHERE id='2'");
$insert->bindValues(':id',2);
$insert->execute();
$insert=$cmd->fetch(PDO::FETCH_ASSOC);

foreach($resultado as $key => $value){
    echo $key.":".$value."<br>";
}

?>

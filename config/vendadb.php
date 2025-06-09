<?php
$database = 'mysql:database=pontodevenda;host=localhost';
$username = 'root';
$password = 'root';

try{
    $pdo = new PDO ($database, $username, $password);
} catch(Exception $e){
    echo "Não foi possível conectar ao banco";
}

$insert->$pdo query("INSERT INTO venda (id, id_funcionario ,id_cliente, id_produto, data_venda, valor, forma_pagamento) VALUES
(1, 1, 2, 3, 10/05/2025, 3500, 'PIX'),
(2, 5, 1, 1, 20/09/2025, 3000, 'Dinheiro'),
(3, 3, 3, 4, 25/12/2027, 150, 'Cartão'),
(4, 4, 4, 2, 04/04/2027, 2000, 'Cartão'),
(5, 2, 5, 5, 02/03/2022, 3000, 'PIX')");
?>
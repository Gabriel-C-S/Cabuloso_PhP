<?php //defininfo dados de conexão com o banco de dados
$host='localhost';
$db='pdv';
$user='root';
$pass='';

//tenta criar conexão com o banco de dados
try{
    $pdo=new PDO("mysql:host=$host;dbname=$db", $user,$pass);
} catch(PDOException $e){
    //caso de erro. mostra essa mensagem
    die("Erro de conexão: ". $e->getMessage());
}
?>
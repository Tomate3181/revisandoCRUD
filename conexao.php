<?php 

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_crud';

$conexao = new mysqli($hostname, $username, $password, $database);

if($conexao->connect_error){
    die('Falha na conexão com o banco' . $conexao->connect_error);
}

?>
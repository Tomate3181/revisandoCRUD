<?php
session_start();
include_once '../conexao.php';

if(!isset($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1><?=$_SESSION['usuario']?></h1>
    <a href="../desconectar.php">Sair</a>
</body>
</html>
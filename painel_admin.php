<?php

session_start();

if(!isset($_SESSION['admin_logado'])){
    header('Location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
</head>
<body>
    <h2>Bem vindo, Administrador!</h2>
    <a href="cadastrar_produto.php">
        <button>Cadastrar Produto</button>
</body>
</html>
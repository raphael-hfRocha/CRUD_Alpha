<?php
    session_start();

    if(!isset($_SESSION['adm_logado'])){
        header("Location:login.php");
        exit();
    }

    require_once('conecta.php');
    
    $mensagem = '';

    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
        $id = $_GET['id'];
        try{
            $stmt = $pdo->prepare('DELETE FROM produtos WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $mensagem = "Produto excluido com sucesso!";
            } else {
                $mensagem = "Erro ao excluir o produto " . $id . " !";
            }
        } catch (PDOException $e){
            echo "Erro ao executar operação: " . $e;
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha: Deletar Produto! </title>
</head>
<body>
    <h2> Deletar produto </h2>
    <p><?php echo $mensagem ?> </p>
    <a href="listar_produtos.php"> Voltar à listagem de produtos </a>
</body>
</html>
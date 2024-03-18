<?php

session_start();

require_once('conexao.php');


if(!isset($_SESSION['admin_logado'])){
    header('Location:login.php');
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // $_SERVER['REQUEST_METHOD']: Retorna o método usado para acessar a página


    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $url_imagem = $_POST['url_imagem'];


    $imagemcompleta = $_FILES['imagem'];
    $imagem = $_FILES['imagem']['name'];

    $target_dir = "../Uploads/";

    // $target_file = $target_dir . basename($imagem); (Forma de atribuir a variável $target_file)
    $target_file = $target_dir . $imagem;


    $base_url = "http://localhost/Alpha/" . "Uploads/" . basename($imagem);


    // Mover a imagem carregando para o diretório de destino
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $target_file)) {
        echo"<p>imagem" . basename($imagem) . "foi carregada.</p>";
    } else {
        echo"<p>Falha ao carregar a imagem.</p>";
    }

    try {
        $sql = 'INSERT INTO PRODUTOS(nome, descricao, preco, imagem, url_imagem) VALUES (:nome, :descricao, :preco, :imagem, :url_imagem)';
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);

        $stmt->execute();

        echo "<p style='color: green'>Produto cadastrado com sucesso.</p>";
    } catch(PDOException $e) {
        echo "<p style='color: red'>Erro ao cadastrar produto: " . $e->getMessage() . ".</p>";
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
</head>
<body>
    <h2>Cadastro de produto</h2>

    <form action="" method="post" enctype="multipart/">
        <label for="nome">Nome:</label>]
        <input type="text" name="nome" id="nome">
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea>
        <label for="preco">Preço:</label>]
        <input type="number" name="preco" id="preco" step=".0.01" required>
        <label for="imagem">Imagem:</label>]
        <input type="file" name="imagem" id="imagem">
        <label for="url_imagem">url imagem:</label>]
        <input type="text" name="url_imagem" id="url_imagem">
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html> 
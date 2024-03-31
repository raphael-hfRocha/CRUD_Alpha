<?php

session_start();

require_once('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // $_SERVER['REQUEST_METHOD']: Retorna o método usado para acessar a página
    $nome = $_POST['nome'];
    $preco = str_replace(',', '.', $_POST['preco']);
    $descricao = $_POST['descricao'];
    $imagemcompleta = $_FILES['imagem']['name'];
    $imagem = $_FILES['imagem']['tmp_name'];
    $url_imagem = $_POST['url_imagem'];

    $target_dir = "uploads/";

    // $target_file = $target_dir . basename($imagem); (Forma de atribuir a variável $target_file)
    $target_file = $target_dir . basename($imagem);


    $base_url = "http://localhost/Alpha/" . "uploads/" . $imagemcompleta;


    move_uploaded_file($imagem, $target_file);

    $sql = 'INSERT INTO PRODUTOS(nome, descricao, preco, imagem, url_imagem) VALUES (:nome, :descricao, :preco, :imagem, :url_imagem)';
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $target_file, PDO::PARAM_STR);
        $stmt->bindParam(':url_imagem', $base_url, PDO::PARAM_STR);

        $stmt->execute();

        header('Location: listar_produto.php');
        exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid text-center">
        <h1>Cadastro de produto</h1>
    </div>

    <div class="container">
        <form action="cadastrar_produto.php" method="POST" style="max-width: 500px; margin: 0 auto;" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição" required></textarea>
            </div>
            <div class="form-group">
                <label for="preco">Preço:</label>
                <input type="text" name="preco" placeholder="R$0,00" class="form-control" id="preco" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem</label>
                <input type="file" name="imagem" id="imagem" class="form-control">
            </div>
            <div class="form-group">
                <label for="url_imagem">URL da Imagem:</label>
                <input type="text" name="url_imagem" id="url_imagem" class="form-control" readonly>
            </div>
            <div class="text-center" style="margin-top: 10px;">
                <button type="button" class="btn btn-secondary">
                    <a href="painel_admin.php">Voltar ao Painel de Administrador</a>
                </button>
                <button type="submit" class="btn btn-primary">Cadastrar Produto</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
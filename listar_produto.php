<?php
session_start();

require_once('conexao.php');

if (!isset($_SESSION['admin_logado'])) {
    header("Location:login.php");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM PRODUTOS"); // stmt = Statement
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Produtos</title>
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
    <h1>Listagem de Produtos</h1>

    <ul class="nav nav-pills">
        <li class="nav-item">
            <button type="button" class="btn btn-secondary">
                <a href="painel_admin.php">Voltar ao meu administrador</a>
            </button>
        </li>
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="cadastrar_produto.php">Cadastrar produto</a>
        </li>
    </ul>
    <div class="container-fluid text-center">
        <table class="table table-hover" style="margin-top: 60px;">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço</th>
                    <th>Imagem</th>
                    <th>URL Imagem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="table-light">
                <?php foreach ($produtos as $produto) : ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['descricao']; ?></td>
                        <td>R$<?php echo number_format($produto["preco"], 2, ',', '.') ?></td>
                        <td><img style="width: 300px; height: 250px;" src="<?php echo $produto['imagem']; ?>"></td>

                        <td><?php echo $produto['url_imagem']; ?></td>
                        <td>
                            <button type="button" class="btn btn-success">
                                <a href="editar_produto.php?id=<?php echo $produto['id']; ?>">Editar</a>
                            </button>
                            <button type="button" class="btn btn-danger">
                                <a href="deletar_produto.php?id=<?php echo $produto['id']; ?>">Excluir</a>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
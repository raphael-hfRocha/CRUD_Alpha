editar_produto.php

<?php
//uma sessão é iniciada e verifica-se se um administrador está logado. Se não estiver, ele é redirecionado para a página de login.
session_start();


if (!isset($_SESSION['admin_logado'])) {
    header('Location: login.php');
    exit();
}

require_once('conexao.php');
//o script faz uma conexão com o banco de dados, usando os detalhes de configuração especificados em conexao.php

// Se a página foi acessada via método GET, o script tenta recuperar os detalhes do produto com base no ID passado na URL.
if ($_SERVER['REQUEST_METHOD'] == 'GET') { //A superglobal $_SERVER é um array que contém informações sobre cabeçalhos, caminhos e locais de scripts. O REQUEST_METHOD é um dos índices deste array e é usado para determinar qual método de requisição foi utilizado para acessar a página, seja ele GET, POST, PUT, entre outros

    if (isset($_GET['id'])) { //$_GET é uma superglobal em PHP, o que significa que ela está disponível em qualquer lugar do seu script, sem necessidade de definição ou importação global. Ela contém dados enviados através da URL (também conhecidos como parâmetros de query string). Quando um usuário acessa uma URL como http://exemplo.com/pagina.php?id=123, o valor 123 é passado para o script pagina.php através do método GET, e você pode acessá-lo com $_GET['id'].
        $id = $_GET['id'];
        try {
            $stmt = $pdo->prepare("SELECT * FROM PRODUTOS WHERE ID = :id"); //Quando você executa uma consulta SELECT no banco de dados usando PDO e utiliza o método fetch(PDO::FETCH_ASSOC), o resultado é um array associativo, onde cada chave do array é o nome de uma coluna da tabela no banco de dados, e o valor associado a essa chave é o valor correspondente daquela coluna para o registro selecionado
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); //PDO::PARAM_INT especifica que o valor é um inteiro. Isso é útil para o PDO saber como tratar o valor antes de enviá-lo ao banco de dados.  Especificar o tipo de dado pode melhorar o desempenho e a segurança da sua aplicação. É uma constante da classe PDO que representa o tipo de dado inteiro para ser usado com métodos como bindParam()
            $stmt->execute();
            $produto = $stmt->fetch(PDO::FETCH_ASSOC); //$produto é um array associativo que contém os detalhes do produto que foi recuperado do banco de dados. Por exemplo, se a tabela de produtos tem colunas como ID, NOME, DESCRICAO, PRECO, e URL_IMAGEM, então o array $produto terá essas chaves, e você pode acessar os valores correspondentes usando a sintaxe de colchetes, 
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    } else {
        header('Location: listar_produtos.php');
        exit();
    }
}

// Se o formulário de edição foi submetido, a página é acessada via método POST, e o script tenta atualizar os detalhes do produto no banco de dados com as informações fornecidas no formulário.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $url_imagem = $_POST['url_imagem'];

    try {
        $stmt = $pdo->prepare("UPDATE PRODUTOS SET NOME = :nome, DESCRICAO = :descricao, PRECO = :preco, URL_IMAGEM = :url_imagem WHERE ID = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);
        $stmt->execute();

        header('Location: listar_produtos.php');
        exit();
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
<!-- Um formulário de edição é apresentado ao administrador, preenchido com os detalhes atuais do produto, permitindo que ele faça modificações e submeta o formulário para atualizar os detalhes do produto -->
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
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
        <h1>Editar Produto</h1>
    </div>
    <form action="editar_produto.php" method="post" style="max-width: 500px; margin: 0 auto;">
        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" name="nome_cliente" class="form-control" name="nome" id="nome" placeholder="Nome">
        </div>
        <div class="form-group">
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" class="form-control" id="descricao" placeholder="Descrição" required></textarea>
        </div>
        <div class="form-group">
            <label for="preco">Preço:</label>
            <input type="number" name="preco" class="form-control" id="preco" placeholder="Preço" step=".0.01" required>
        </div>
        <div class="form-group">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" id="imagem" class="form-control">
        </div>
        <div class="form-group">
            <label for="url_imagem">URL da Imagem:</label>
            <input type="text" name="url_imagem" id="url_imagem" class="form-control">
        </div>
        <div class="text-center" style="margin-top: 10px;">
            <button type="button" class="btn btn-secondary">
                <a href="listar_produto.php">Voltar à Lista de Produtos</a>
            </button>
            <button type="submit" class="btn btn-primary">Atualizar Produto</button>
        </div>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
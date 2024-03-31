<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            width: 100%;
            max-width: 1024px;
            align-items: center;
            height: 550px;
            flex-direction: column;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <section class="login-form">
        <div class="container-fluid text-center">
            <h1>Login do Administrador</h1>
            <br>
            <form action="processa_login.php" method="post" style="max-width: 500px; margin: 0 auto;">
                <div class="form-group">
                    <label for="nome" class="visually-hidden">Nome</label>
                    <input type="text" class="form-control form-control-lg" id="nome" name="nome" placeholder="Nome" required>
                </div>
                <br>
                <div class="form-group">
                    <label for="inputPassword2" class="visually-hidden">Password</label>
                    <input type="password" class="form-control form-control-lg" id="senha" name="senha" placeholder="Senha" required>
                </div>
                <br>
                <div class="text-center">
                    <input type="submit" class="form-control form-control-sm btn btn-primary mb-3" value="Entrar">
                </div>
                <?php
                if (isset($_GET['erro'])) {
                    echo '<p style="color:red;">Nome de usuário ou senha incorretos!</p>';
                }
                ?>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>
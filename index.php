<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="processar-dados.php" method="post">

        <label for="email">Email</label>
        <input type="email" name="email" class='input' required>

        <label for="senha">Senha</label>
        <input type="password" name="senha" class='input' required>

        <div class="acoes">
            <button type="submit" name='login'>Login</button>
            <a href="cadastro-usuario.php" class="link">Criar conta</a>
        </div>
    </form>
</body>
</html>
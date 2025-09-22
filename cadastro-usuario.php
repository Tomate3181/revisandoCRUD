<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <form action="processar-dados.php" method="post">

                <label for="nome">Nome</label>
                <input type="text" name="nome" required>

                <label for="email">Email</label>
                <input type="email" name='email' required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" required>

                <div class="acoes">
                    <button type="submit" name='cadastrar-usuario'>Criar conta</button>
                    <a href="index.php">Login</a>
                </div>

            </form>
        </div>
    </main>
</body>
</html>
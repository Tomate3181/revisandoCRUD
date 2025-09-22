<?php 
session_start();
include '../conexao.php';
if (!isset($_SESSION['admin'])) {
    header("Location: ../index.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuários</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <form action="../processar-dados.php" method="post">

                <label for="nome">Nome</label>
                <input type="text" name="nome" required>

                <label for="email">Email</label>
                <input type="email" name='email' required>

                <label for="senha">Senha</label>
                <input type="password" name="senha" required>

                <label for="nivel_acesso">Nivel de Acesso</label>
                <select name="nivel_acesso">
                    <option value="admin">Administrador</option>
                    <option value="usuario">Usuário</option>
                </select>

                <div class="acoes">
                    <button type="submit" name='admin_cadastrar-usuario'>Cadastrar Usuário</button>
                    <a href="./admin_usuarios.php">Voltar</a>
                </div>

            </form>
        </div>
    </main>
</body>
</html>
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

                <?php 
                
                if(isset($_GET['id'])){
                    $usuario_id = $_GET['id'];
                    $sql = "SELECT nome, email FROM usuarios WHERE id=?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("i", $usuario_id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if($resultado->num_rows > 0) {
                        $dados_usuario = $resultado->fetch_assoc();
                ?>
                <input type="hidden" name="id" value="<?=$usuario_id?>">

                <label for="nome">Nome</label>
                <input type="text" name="nome" value="<?=$dados_usuario['nome']?>" required>

                <label for="email">Email</label>
                <input type="email" name='email' value="<?=$dados_usuario['email']?>" required>

                <label for="status">Status</label>
                <select name="status">
                    <option value="ativo">Ativo</option>
                    <option value="desativado">Desativado</option>
                </select>

                <label for="nivel_acesso">Nivel de Acesso</label>
                <select name="nivel_acesso">
                    <option value="usuario">Usuário</option>
                    <option value="admin">Administrador</option>
                </select>
                <?php
                    }
                    else {
                        echo "usuario não encontrado";
                    }
                }
                ?>

                <div class="acoes">
                    <button type="submit" name='admin_editar-usuario'>Editar</button>
                    <a href="./admin_usuarios.php">Voltar</a>
                </div>

            </form>
        </div>
    </main>
</body>
</html>
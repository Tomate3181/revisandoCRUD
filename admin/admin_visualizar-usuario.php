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
    <title>Visualizar Usuário</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <div class="header">
                <h1>Bem vindo ADMIN <?=$_SESSION['admin']?></h1>
                <h2 class='titulo'>Usuário</h2>
                <a class='link' href="admin_usuarios.php">Voltar</a>
                <a href="../desconectar.php">Sair</a>
            </div>
            <div class="usuarios">
                <?php 
                
                if(isset($_GET['id'])){
                    $usuario_id = $_GET['id'];
                    $sql = "SELECT nome, email, status, nivel_acesso FROM usuarios WHERE id=?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("i", $usuario_id);
                    $stmt->execute();
                    $resultado = $stmt->get_result();

                    if($resultado->num_rows > 0) {
                        $dados_usuario = $resultado->fetch_assoc();
                ?>


                <label for="nome">Nome</label>
                <p>
                    <?=$dados_usuario['nome']?>
                </p>

                <label for="email">Email</label>
                <p>
                    <?=$dados_usuario['email']?>
                </p>
                <label for="status">Status</label>
                <p>
                    <?=$dados_usuario['status']?>
                </p>
                <label for="nivel-acesso">Nivel de Acesso</label>
                <p>
                    <?=$dados_usuario['nivel_acesso']?>
                </p>
                <?php
                    }
                    else {
                        echo "usuario não encontrado";
                    }
                }
                ?>
            </div>
        </div>
    </main>
</body>
</html>
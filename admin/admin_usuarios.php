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
    <title>Início - Visualizar Usuários</title>
</head>
<body>
    <main>
        <div class="conteudo">
            <div class="header">
                <h1>Bem vindo ADMIN <?=$_SESSION['admin']?></h1>
                <h2 class='titulo'>Usuários</h2>
                <a class='link' href="admin_cadastro-usuario.php">Cadastrar Usuário</a>
                <a href="../desconectar.php">Sair</a>
            </div>
            <div class="usuarios">
                <table>
                    <thead>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Nivel de Acesso</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        <?php 
                        $sql = "SELECT id, nome, email, usuarios.status, nivel_acesso FROM usuarios";

                        $stmt = $conexao->prepare($sql);
                        $stmt->execute();
                        $resultado = $stmt->get_result();

                        if($resultado->num_rows > 0){
                            while($usuario = $resultado->fetch_assoc()){
                        ?>
                            <tr>
                                <td><?=$usuario['id']?></td>
                                <td><?=$usuario['nome']?></td>
                                <td><?=$usuario['email']?></td>
                                <td><?=$usuario['status']?></td>
                                <td><?=$usuario['nivel_acesso']?></td>
                                <td>
                                    <a href="admin_visualizar-usuario.php?id=<?=$usuario['id']?>">Visualizar</a>
                                    <a href="admin_editar-usuario.php?id=<?=$usuario['id']?>">Editar</a>
                                    <form action="../processar-dados.php" method="post">
                                        <button onclick="return confirm('Deseja excluir esse usuário?');" type="submit" value="<?=$usuario['id']?>" name="deletar-usuario">Excluir</button>
                                    </form>
                                </td>
                            </tr>

                        <?php

                            }
                        }
                        
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
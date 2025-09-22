<?php 
session_start();
include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    
    if(isset($_POST['login'])) {
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $user_status = 'ativo';
    
        $sql = 'SELECT nome, email, senha, nivel_acesso FROM usuarios WHERE email = ? AND usuarios.status = ?';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ss', $email, $user_status);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        if($resultado->num_rows == 1) {
            $usuario = $resultado->fetch_assoc();
        
            $senha_banco = $usuario['senha'];

            if (password_verify($senha, $senha_banco)) {

                unset($_SESSION['admin']);
                unset($_SESSION['usuario']);

                if($usuario['nivel_acesso'] == 'admin'){
                    $_SESSION['admin'] = $usuario['nome'];
                    header("Location: ./admin/admin_usuarios.php");
                    exit();
                } 
                else {
                    $_SESSION['usuario'] = $usuario['nome'];
                    header("Location: ./user/user_home.php");
                    exit();
                }

            } else {
                echo "<script>alert('Senha incorreta!');</script>";
                echo "<a href='./index.php'>Voltar</a>";
                exit();
            }
            
            
        } else {
            echo "<script>alert('Usuario não encontrado!')</script>";
            echo "<a href='./index.php'>Voltar</a>";
            exit();
        }

        $stmt->close();

    }

    if(isset($_POST['cadastrar-usuario'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $senha = $_POST['senha'];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $user_status = 'ativo';
        $nivel_acesso = 'usuario';
        
        
        $sql = 'INSERT INTO usuarios (nome, email, senha, usuarios.status, nivel_acesso) VALUES (?, ?, ?, ?, ?)';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('sssss', $nome, $email, $senha_hash, $user_status, $nivel_acesso);
        $stmt->execute();
        $stmt->close();

        $_SESSION['usuario'] = $nome;

        header("Location: ./user/user_home.php");
        exit();
    }

    if(isset($_POST['admin_cadastrar-usuario'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $senha = $_POST['senha'];
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $user_status = 'ativo';
        $nivel_acesso = $_POST['nivel_acesso'];
        
        
        $sql = 'INSERT INTO usuarios (nome, email, senha, usuarios.status, nivel_acesso) VALUES (?, ?, ?, ?, ?)';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('sssss', $nome, $email, $senha_hash, $user_status, $nivel_acesso);
        $stmt->execute();
        $stmt->close();

        header("Location: ./admin/admin_usuarios.php");
        exit();
    }

    if(isset($_POST['admin_editar-usuario'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        $user_status = $_POST['status'];
        $nivel_acesso = $_POST['nivel_acesso'];
        
        
        $sql = 'UPDATE usuarios SET nome=?, email=?, status=?, nivel_acesso=? WHERE id=?';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('ssssi', $nome, $email, $user_status, $nivel_acesso, $id);
        $stmt->execute();
        $stmt->close();

        header("Location: ./admin/admin_usuarios.php");
        exit();
    }

    if(isset($_POST['deletar-usuario'])) {
        $id = $_POST['deletar-usuario'];

        $sql = 'DELETE FROM usuarios WHERE id=?';
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();

        header("Location: ./admin/admin_usuarios.php");
        exit();
    }

}

$conexao->close();
?>
<?php
    include "../include/MySql.php";

    $msgErro = "";
    $codigo = "";

    if (isset($_GET['id'])){
        $codigo = $_GET['id'];

        $sql = $pdo->prepare("DELETE FROM USUARIO WHERE codigo = ?");
        if ($sql->execute(array($codigo))){
            if ($sql->rowCount() > 0){
                $msgErro = "Usuário excluído com sucesso!";
                header('location:listUsuario.php');
            } else {
                $msgErro = "Código não localizado!";
            }
        } else {
            $msgErro = "Erro ao excluir usuário!";
        }
    }
    echo "Mensagem de erro: $msgErro";
?>
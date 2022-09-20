<?php
include "site/include/MySql.php";

$codigo = "";
$nome = "";
$email = "";
$telefone = "";
$senha = "";
$administrador = "";

$nomeErro = "";
$emailErro = "";
$telefoneErro = "";
$senhaErro = "";
$msgErro = "";

if (isset($_GET['id'])) {
    $codigo = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM USUARIO WHERE codigo = ?");
    if ($sql->execute(array($codigo))) {
        $info = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($info as $key => $value) {
            $codigo = $value['codigo'];
            $nome = $value['nome'];
            $email = $value['email'];
            $telefone = $value['telefone'];
            $senha = ''; //$value['senha'];
        }
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {

    if (!empty($_FILES["image"]["name"])) {
        //Pegar informações do arquivo
        $fileName = basename($_FILES['image']['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
        //Array de extensoes permitidas 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'jfif');

        if (in_array($fileType, $allowTypes)) {
            $image = $_FILES['image']['tmp_name'];
            $imgContent = file_get_contents($image);
            if (empty($_POST['nome']))
                $nomeErro = "Nome é obrigatório!";
            else
                $nome = $_POST['nome'];

            if (empty($_POST['email']))
                $emailErro = "Email é obrigatório!";
            else
                $email = $_POST['email'];

            if (empty($_POST['telefone']))
                $telefoneErro = "Telefone é obrigatório!";
            else
                $telefone = $_POST['telefone'];

            if (empty($_POST['senha']))
                $senhaErro = "Senha é obrigatório!";
            else
                $senha = $_POST['senha'];

            if ($email && $nome && $senha && $telefone) {
                //Verificar se ja existe o email
                $sql = $pdo->prepare("SELECT * FROM USUARIO WHERE email = ? AND codigo <> ?");
                if ($sql->execute(array($email, $codigo))) {
                    if ($sql->rowCount() <= 0) {
                        $sql = $pdo->prepare("UPDATE USUARIO SET codigo=?, 
                                                                nome=?, 
                                                                email=?, 
                                                                telefone=?, 
                                                                senha=?,
                                                                imagem=?
                                                        WHERE codigo=?");

                        if ($sql->execute(array($codigo, $nome, $email, $telefone, md5($senha), $image, $codigo))) {
                            $msgErro = "Dados alterados com sucesso!";
                            header('location:listUsuario.php');
                        } else {
                            $msgErro = "Dados não cadastrados!";
                        }
                    } else {
                        $msgErro = "Email de usuário já cadastrado!!";
                    }
                } else {
                    $msgErro = "Erro no comando UPDATE!";
                }
            } else {
                $msgErro = "Dados não alteardos!";
            }
        } else {
            $msgErro = "Somente arquivos JPG, JPEG, PNG, GIFF são permitidos";
        }
    } else {
        $msgErro = "Imagem não selecionada!!";
    }
}

?>


    <form method="POST">
        <fieldset>
            <legend>Alterar Usuário</legend>

            Nome: <input type="text" name="nome" value="<?php echo $nome ?>">
            <span class="obrigatorio">*<?php echo $nomeErro ?></span>
            <br>
            Email: <input type="text" name="email" value="<?php echo $email ?>">
            <span class="obrigatorio">*<?php echo $emailErro ?></span>
            <br>
            Telefone: <input type="text" name="telefone" value="<?php echo $telefone ?>">
            <span class="obrigatorio">*<?php echo $telefoneErro ?></span>
            <br>
            Senha: <input type="password" name="senha" value="<?php echo $senha ?>">
            <span class="obrigatorio">*<?php echo $senhaErro ?></span>
            <br>
            <input type="checkbox" name="administrador">administrador
            <br>
            <input type="file" name="image">
            <br>
            <input type="submit" value="Alterar" name="submit">
        </fieldset>
    </form>
    <span><?php echo $msgErro ?></span>

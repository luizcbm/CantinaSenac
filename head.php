<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="site/css/principal.css">
    <link rel="stylesheet" href="site/css/style.css">
    <link rel="stylesheet" href="site/css/lista.css">
    <link rel="stylesheet" href="site/css/cadastro.css">
    <link rel="stylesheet" href="site/css/login.css">
    <link rel="stylesheet" href="site/css/sobre.css">
    <link rel="stylesheet" href="site/css/doces.css">

    <script src="assets/js/index.js"></script>
    <title>Cantina Senac</title>

</head>
<?php 
$pagina = "fundologin"
// fazer uma fução php -> Verificar qual a pagina vc esta.
// if(login){
//  $pagina = "fundoLogin"
// } else if (cadastro){
//     $pagina = "fundocadastro"
// }

?>
<body id="<?php echo $pagina?>">



    <?php
    include "nav.php";
    ?>
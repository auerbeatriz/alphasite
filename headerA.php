<!DOCTYPE html>

<?php
if(isset($_REQUEST["pg"])) {
    $pg = $_REQUEST["pg"];
    switch ($pg):
        case "cadFor":
            $_SESSION["erros"] = null;
            header("Location: form_cad_fornecedor.php");
        break;
        case "cadCli":
            $_SESSION["erros"] = null;
            header("Location: form_cad_cliente.php");
        break;
        case "cadPro":
            $_SESSION["erros"] = null;
            header("Location: form_cad_produto.php");
        break;
        case "cadVen":
            $_SESSION["erros"] = null;
            header("Location: form_cad_venda.php");
        break;
        case "cadCad":
            $_SESSION["erros"] = null;
            header("Location: form_cad_caderneta.php");
        break;

        case "conFor":
            $_SESSION["erros"] = null;
            header("Location: consulta_fornecedor.php");
        break;
        case "conCli":
            $_SESSION["erros"] = null;
            header("Location: consulta_cliente.php");
        break;
        case "conPro":
            $_SESSION["erros"] = null;
            header("Location: consulta_produto.php");
        break;

        case "conCad":
            $_SESSION["erros"] = null;
            header("Location: consulta_caderneta.php");
        break;

        case "gerenciar":
            $_SESSION["erros"] = null;
            header("Location: gerenciar_adm.php");
        break;
    endswitch;
}

?>

  <html>
    <head>
        <meta charset ="utf-8">
        <title> Pomar Hortifruti </title>
        <link href="css/style.css" rel="stylesheet">
        <!-- Aqui alteramos o titulo da página para o nome do usuário logado -->
        <script type="text/javascript">
            document.title = "<?=$nome?>"
        </script> 
    </head>
    <body>
        <figure></figure>
        <nav class="menu">
            <ul>
                <li><a href="home.php"> home </li>
                <li> consulta 
                    <ul>
                        <li><a href="consulta_fornecedor.php"> fornecedores </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conCli"> clientes </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conPro"> produtos </a></li>
                        <li> vendas </li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=conCad"> caderneta </a></li>
                    </ul>
                </li>
                <li> cadastro 
                    <ul>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadFor"> fornecedor </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadCli"> cliente </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadPro"> produto <a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadVen"> venda </a></li>
                        <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=cadCad"> caderneta </a></li>
                    </ul>
                </li>
                <li><a href="<?=$_SERVER['PHP_SELF']?>?pg=gerenciar"> gerenciar adms </a></li>
                <li><a href="close_session.php"> sair </a></li>
            </ul>
        </nav>
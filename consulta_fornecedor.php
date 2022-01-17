<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();

/*  todo o código da página só será exibido caso ele esteja logado
 * Se não estiver, ele será redirecionado para a página index.html, onde há o formulário de login
 */
if(isset($_SESSION["logado"]) && $_SESSION["logado"]) {
    $post = new Post($con);
    $nome = $post->getAdmName($_SESSION["id"]);

    require_once("headerA.php");
    
    if(isset($_SESSION["success"]) && $_SESSION["success"]) {
        echo "<script type='text/javascript'> alert('Fornecedor cadastrado com sucesso!') </script>";
        unset($_SESSION["success"]);
    }
    
    ?>

    <h1> Fornecedores </h1>

    <form action="" method="post" class="busca">
        <label for="busca_razao_social">Razão social:</label>
        <input type="search" id="busca_razao_social" name="razao_social">

        <label for="busca_cnpj">CNPJ:</label>
        <input type="search" id="busca_cnpj" name="cnpj">

        <input type="submit" name="filtragem" value="Filtrar"></input>
    </form>
    <br>

    <table class="consulta">
        <tr>
            <th class='col'>RAZÃO SOCIAL</th>
            <th class='col'>CNPJ</th>
            <th class='col'>E-MAIL</th>
            <th class='col'>TELEFONE</th>
            <th class='col'>ENDEREÇO</th>
            <th class='col'>Ações</th>
    </tr>

    <?php
    if(isset($_POST["filtragem"])) {
        $razaoSocial = $_POST["razao_social"];
        $cnpj = $_POST["cnpj"];

        $url="http://localhost/pomar_hortifruti/obtem_fornecedores.php?razaoSocial=$razaoSocial&cnpj=$cnpj";
        
    } else {
        $url="http://localhost/pomar_hortifruti/obtem_fornecedores.php";
    }
    
    $result = json_decode(file_get_contents($url));

    if($result->success == 1) {
        foreach($result->fornecedores as $row) {
            echo "
            <tr class='linha'>
                <td class='col'>".$row->razao_social."</td>
                <td class='col'>".$row->cnpj."</td>
                <td class='col'>".$row->email."</td>
                <td class='col'>".$row->telefone."</td>
                <td class='col'>".$row->endereco."</td>
                <td class='col'> <label class='editar'> <a href='update_fornecedor.php?id=". $row->id ."&op=leitura'>editar</a> </label> <label class='excluir'><a href='excluir.php?campo=id&id=$row->id&op=fornecedor'>excluir</a></label> </td>
            </tr>";
        }
    } else {
        echo $result->message;
    }
    ?></table><?php

    include_once("footer.php");
}
else {
    header("Location: index.php");
}

mysqli_close($con);
?>

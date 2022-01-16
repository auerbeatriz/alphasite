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
        $fornecedores = $post->getFornecedoresInFilter($razaoSocial, $cnpj);
    } else {
        $fornecedores = $post->getFornecedores();
    }
    
    while ($fornecedor = mysqli_fetch_assoc($fornecedores)) {
        
        $id = $fornecedor["id"];
        $razaoSocial = utf8_encode(strtoupper(filter_var($fornecedor["razao_social"], FILTER_SANITIZE_SPECIAL_CHARS)));
        $logradouro = utf8_encode(filter_var($fornecedor["logradouro"], FILTER_SANITIZE_SPECIAL_CHARS));
        $complemento = utf8_encode(filter_var($fornecedor["complemento"], FILTER_SANITIZE_SPECIAL_CHARS));
        $bairro = utf8_encode(filter_var($fornecedor["bairro"], FILTER_SANITIZE_SPECIAL_CHARS));
        $cidade = utf8_encode(filter_var($fornecedor["cidade"], FILTER_SANITIZE_SPECIAL_CHARS));
        $uf = strtoupper(filter_var($fornecedor["uf"],FILTER_SANITIZE_SPECIAL_CHARS));

        $cep =  $fornecedor['cep'];
        if(filter_var($fornecedor["numero"], FILTER_VALIDATE_INT)) {
            $numero = $fornecedor["numero"];
        } else { $numero = "s/n"; }

        $endereco = "Cep: $cep, $logradouro, $numero, $complemento, $bairro - $cidade, $uf";
        
        echo "
        <tr class='linha'>
            <td class='col'>$razaoSocial</td>
            <td class='col'>".$fornecedor['cnpj']."</td>
            <td class='col'>".utf8_encode($fornecedor['email'])."</td>
            <td class='col'>".$fornecedor['telefone']."</td>
            <td class='col'>$endereco</td>
            <td class='col'> <label class='editar'> <a href='update_fornecedor.php?id=$id&op=leitura'>editar</a> </label> <label class='excluir'><a href='excluir.php?campo=id&id=$id&op=fornecedor'>excluir</a></label> </td>
        </tr>";

    }
    ?></table><?php

    include_once("footer.php");
}
else {
    header("Location: index.php");
}

mysqli_close($con);
?>

<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php"); 

if(isset($_SESSION["success"]) && $_SESSION["success"]) {
    echo "<script type='text/javascript'> alert('Cliente cadastrado com sucesso!') </script>";
    unset($_SESSION["success"]);
}

?>

<h1> Clientes </h1>

<form action="" method="post" class="busca">
        <label for="busca_nome">Nome:</label>
        <input type="search" id="busca_nome" name="nome">

        <label for="busca_cpf">CPF:</label>
        <input type="search" id="busca_cpf" name="cpf">

        <input type="submit" name="filtragem" value="Filtrar"></input>
</form>
<br>

<table class="consulta">
    <tr>
        <th class='col'>NOME</th>
        <th class='col'>CPF</th>
        <th class='col'>E-MAIL</th>
        <th class='col'>TELEFONE</th>
        <th class='col'>ENDEREÇO</th>
        <th class='col'>Ações</th>
</tr>

<?php
if(isset($_POST["filtragem"])) {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];

    $url="http://localhost/pomar_hortifruti/obtem_clientes.php?nome=$nome&cpf=$cpf";
    
} else {
    $url="http://localhost/pomar_hortifruti/obtem_clientes.php";
}

$result = json_decode(file_get_contents($url));

if($result->success == 1) {
    foreach($result->clientes as $row) {
        echo "
        <tr class='linha'>
            <td class='col'>".$row->nome."</td>
            <td class='col'>".$row->cpf."</td>
            <td class='col'>".$row->email."</td>
            <td class='col'>".$row->telefone."</td>
            <td class='col'>".$row->endereco."</td>
            <td class='col'> <label class='editar'> <a href='update_cliente.php?id=". $row->id ."&op=leitura'>editar</a> </label> <label class='excluir'><a href='excluir.php?campo=id&id=". $row->id ."&op=cliente'>excluir</a></label> </td>
        </tr>";
    }
} else {
    echo $result->message;
}
?></table><?php

mysqli_close($con);
include_once("footer.php");
?>

<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php"); ?>

<h1> Clientes </h1>
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

$clientes = $post->getClientes();
while ($cliente = mysqli_fetch_assoc($clientes)) {
    
    $id = $cliente["id"];
    $nome = utf8_encode(strtoupper(filter_var($cliente["nome"], FILTER_SANITIZE_SPECIAL_CHARS)));
    $logradouro = utf8_encode(filter_var($cliente["logradouro"], FILTER_SANITIZE_SPECIAL_CHARS));
    $complemento = utf8_encode(filter_var($cliente["complemento"], FILTER_SANITIZE_SPECIAL_CHARS));
    $bairro = utf8_encode(filter_var($cliente["bairro"], FILTER_SANITIZE_SPECIAL_CHARS));
    $cidade = utf8_encode(filter_var($cliente["cidade"], FILTER_SANITIZE_SPECIAL_CHARS));
    $uf = strtoupper(filter_var($cliente["uf"],FILTER_SANITIZE_SPECIAL_CHARS));

    $cep =  $cliente['cep'];
    if(filter_var($cliente["numero"], FILTER_VALIDATE_INT)) {
        $numero = $cliente["numero"];
    } else { $numero = "s/n"; }

    $endereco = "Cep: $cep, $logradouro, $numero, $complemento, $bairro - $cidade, $uf";

    echo "
        <tr class='linha'>
            <td class='col'>$nome</td>
            <td class='col'>".$cliente['cpf']."</td>
            <td class='col'>".utf8_encode($cliente['email'])."</td>
            <td class='col'>".$cliente['telefone']."</td>
            <td class='col'>$endereco</td>
            <td class='col'> <label class='editar'><a href='update_cliente.php?id=$id&op=leitura'>editar</a></label> <label class='excluir'><a href='excluir.php?campo=id&id=$id&op=cliente'>excluir</a></label> </td>
        </tr>";

    }
?></table><?php

mysqli_close($con);
include_once("footer.php");
?>

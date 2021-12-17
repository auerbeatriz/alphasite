<?php
require_once("config.php");
include_once("util.php");
include_once("post.php");

session_start();
$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");

echo "<h1> Clientes </h1>";

$clientes = $post->getClientes();
while ($cliente = mysqli_fetch_assoc($clientes)) {
    
    $nomeCliente = utf8_encode(filter_var($cliente["nome"], FILTER_SANITIZE_SPECIAL_CHARS));
    $logradouro = utf8_encode(filter_var($cliente["logradouro"], FILTER_SANITIZE_SPECIAL_CHARS));
    $complemento = utf8_encode(filter_var($cliente["complemento"], FILTER_SANITIZE_SPECIAL_CHARS));
    $bairro = utf8_encode(filter_var($cliente["bairro"], FILTER_SANITIZE_SPECIAL_CHARS));
    $cidade = utf8_encode(filter_var($cliente["cidade"], FILTER_SANITIZE_SPECIAL_CHARS));
    $uf = strtoupper(filter_var($cliente["uf"],FILTER_SANITIZE_SPECIAL_CHARS));

    if(filter_var($cliente["numero"], FILTER_VALIDATE_INT)) {
        echo "<label><b>".$nomeCliente."</b></label><br>
        <label>".$logradouro.", ".$cliente["numero"].", ".$complemento." - ".$bairro." - ".$cidade." - ".$uf." - CEP: ".$cliente["cep"]."</label><br>
        <label>CPF: ".$cliente["cpf"]."<label><br>
        <label>E-mail: ".utf8_encode($cliente["email"])."<label><br>
        <label>Telefone: ".$cliente["telefone"]."<label><hr>";
    }
    else {
        echo "<label><b>".$nomeCliente."</b></label><br>
        <label>".$logradouro.", ".$complemento." - ".$bairro." - ".$cidade." - ".$uf." - CEP: ".$cliente["cep"]."</label><br>
        <label>CPF: ".$cliente["cpf"]."<label><br>
        <label>E-mail: ".utf8_encode($cliente["email"])."<label><br>
        <label>Telefone: ".$cliente["telefone"]."<label><br>
        <label><i>O número do endereço não é válido. Por questões de segurança, não será exibido.</i></label><hr>";
    }
}

mysqli_close($con);
include_once("footer.php");
?>

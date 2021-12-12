<?php

require_once("config.php");
include("util.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");
?>

<div id="erros">
        <?=exibeErros($_SESSION["erros"])?>
</div>

<form id="cad-cliente" action="cadastro_cliente.php" method="POST">
    <label for="nome"> Nome: </label>
    <input type="text" name="nome" required="required" placeholder="José da Silva"> <br>

    <label for="email"> Email: </label>
    <input type="email" name="email" required="" placeholder="jose@gmail.com"> <br>

    <label for="telefone"> Telefone: </label>
    <input type="tel" name="telefone" minlength="10" maxlength="12" required="" placeholder="(__)_____-____"> <br>

    <label for="cpf"> CPF: </label>
    <input type="text" name="cpf" size="11" maxlength="11" required="" placeholder="___.___.___-__"> <br>

    <label for="cep"> CEP: </label>
    <input type="text" name="cep" size="8" maxlength="8" placeholder="__-___-___"> <br>

    <label for="logradouro"> Logradouro: </label>
    <input type="text" name="logradouro" placeholder="Colina de Laranjeiras"> <br>

    <label for="numero"> Número: </label>
    <input type="int" name="numero" placeholder="2286"> <br>

    <label for="complemento"> Complemento: </label>
    <input type="text" name="complemento" placeholder="Ap. 804"> <br>

    <label for="bairro"> Bairro: </label>
    <input type="text" name="bairro" placeholder="Colina de Laranjeiras"> <br>

    <label for="cidade"> Cidade: </label>
    <input type="text" name="cidade" placeholder="Serra"> <br>

    <label for="uf"> Estado: </label>
    <input type="text" name="uf" size="2" maxlength="2" placeholder="ES"> <br>    

    <input type="submit" name="btn-cad-cli" value="Cadastrar Cliente">
</form>

<?php
mysqli_close($con);
include_once("footer.php");
?>
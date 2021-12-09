<?php

require_once("config.php");
require_once("post.php");

session_start();

$post = new Post($con);
$nome = $post->getAdmName($_SESSION["id"]);

require_once("headerA.php");
?>

<form id="cad-fornecedor" action="cadastro_fornedor.php">
    <label for="razaoSocial"> Razão social: </label>
    <input type="text" name="razaoSocial" required="required" placeholder="Santos LTDA"> <br>

    <label for="cnpj"> CNPJ: </label>
    <input type="text" name="cnpj" size="14" maxlength="14" required="required" placeholder="__.___.___/____-__"> <br>

    <label for="cep"> CEP: </label>
    <input type="text" name="cep" size="8" maxlength="8" required="required" placeholder="__-___-___"> <br>

    <label for="logradouro"> Logradouro: </label>
    <input type="text" name="logradouro" required="required" placeholder="Av. Eldes Scherrer Souza"> <br>

    <label for="numero"> Número: </label>
    <input type="int" name="numero" required="required" placeholder="2286"> <br>

    <label for="complemento"> Complemento: </label>
    <input type="text" name="complemento" required="" placeholder="Ap. 804"> <br>

    <label for="bairro"> Bairro: </label>
    <input type="text" name="bairro" required="required" placeholder="Colina de Laranjeiras"> <br>

    <label for="cidade"> Cidade: </label>
    <input type="text" name="cidade" required="required" placeholder="Serra"> <br>

    <label for="uf"> Estado: </label>
    <input type="text" name="uf" size="2" maxlength="2" required="required" placeholder="ES"> <br>

    <label for="email"> Email: </label>
    <input type="email" name="email" required="required" placeholder="santosltda@gmail.com"> <br>

    <label for="telefone"> Telefone: </label>
    <input type="tel" name="telefone" minlength="10" maxlength="12" required="" placeholder="(__)_____-____"> <br>

    <input type="submit" name="btn-cad-forn" value="Cadastrar Fornecedor">
</form>

<?php
include_once("footer.php");
?>